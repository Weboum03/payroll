<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BatchUserExport;
use App\Exports\UsersExport;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Imports\UsersImport;
use App\Models\User;
use App\Notifications\NotifyGlobal;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends BaseController
{

    protected $userRepository;

    /**
     * The user repository instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->listing($request);
        $users->map(function ($user) {
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url) ?? null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponse($users, __('ApiMessage.retrievedMessage'));
    }

    public function getUserPaginate(Request $request)
    {
        $users = $this->userRepository->listingPaginate($request);
        $users->through(function ($user) {
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url) ?? null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponseWithPagination($users, __('ApiMessage.retrievedMessage'));
    }

    public function dashboardUser(Request $request)
    {
        $users = $this->userRepository->getDashboardUser($request);
        $users->through(function ($user) {
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url) ?? null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponseWithPagination($users, __('ApiMessage.retrievedMessage'));
    }

    public function getReportUsers(Request $request)
    {
        $users = $this->userRepository->listing($request);
        $users->map(function ($user) {
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url) ?? null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponse($users, __('ApiMessage.retrievedMessage'));
    }

    public function dashboard(Request $request)
    {
        $users = $this->userRepository->getDashboardInfo($request);
        return $this->sendResponse($users, __('ApiMessage.retrievedMessage'));
    }

    public function compareData(Request $request)
    {
        $response = $this->userRepository->compareData($request);
        return $this->sendResponse($response, __('ApiMessage.retrievedMessage'));
    }

    public function checkDocument($type, Request $request)
    {
        $check = $this->userRepository->checkDocument($type, $request->value, $request->user_id);
        if ($type == 'pan_number') {
            $message = 'This PAN number already exists';
        } elseif ($type == 'aadhar_number') {
            $message = 'This aadhar number already exists';
        } elseif ($type == 'phone') {
            $message = 'Phone number already exists';
        } elseif ($type == 'email') {
            $message = 'Email already exists';
        } else {
            $message = 'Already exist';
        }
        return $this->sendResponse($check, $message);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'email'    => 'unique:users|required',
            'phone'    => 'unique:users|required',
            'employee_id'    => 'unique:users|required',
            'prob_end_date' => 'required|after:doj',
        ];

        $message = [
            'prob_end_date.after' => 'Probation End Date should be greater than Joining date'
        ];
        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }
        $user = $this->userRepository->create($input);

        $checkAll = $request->check_all;
        if ($checkAll == 'true') {
            $checkAll = true;
        } elseif ($checkAll == 'false') {
            $checkAll = false;
        }
        if ($checkAll) {
            $checkAll = true;
        } else {
            $checkAll = false;
        }
        $input['check_all'] = $checkAll;

        $user->info()->create($input);

        $role = Role::find($request->role_id);
        if ($role) {
            $user->assignRole([$role->id]);
            $user->role_id = $role->id;
            $user->save();
        }

        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            if (!$request->has($collectionName)) {
                continue;
            }
            $user->uploadMedia($collectionName, $request->$collectionName, ['collection_name' => $collectionName]);
        }


        $attachments = $request->attachments;
        if ($attachments) {
            foreach ($attachments as $file) {
                $collectionName = $file['type'];
                $user->clearMediaCollection($collectionName);
                $user->uploadMedia($collectionName, $file['path'], ['collection_name' => $collectionName, 'title' => $file['title'], 'check' => $file['check']]);
            }
        }

        $loginUser = Auth::user();
        $data = [
            'title' => 'New Onboard',
            'message' => $loginUser->name." onboard ".$user->name,
            'message_details' => 'Details',
        ];

        Helper::sendNotificationToAll($data);

        return $this->sendResponse($user, __('ApiMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->getById($id);
        $user->load('info', 'role', 'deboard');

        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            $picture = $user->getFirstMedia($collectionName);
            if($picture && $picture->custom_properties['check']) {
                $user->setAttribute($collectionName, ($picture->original_url) ?? null);
            } else {
                $user->setAttribute($collectionName, null);
            }
        }

        $mediaItems = $user->getMedia("*");
        $user->setAttribute('files', $mediaItems);
        $user->makeHidden('media');
        return $this->sendResponse($user, __('ApiMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $rules = [
            'prob_end_date' => 'required|after:doj',
        ];

        $message = [
            'prob_end_date.after' => 'Probation End Date should be greater than Joining date'
        ];
        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }
        $user = $this->userRepository->updateById($id, $input);
        $user->info()->updateOrCreate(['user_id' => $id], $input);
        $role = Role::find($request->role_id);
        if ($role) {
            $user->syncRoles($role);
            $user->role_id = $role->id;
            $user->save();
        }

        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            if (!$request->has($collectionName)) {
                continue;
            }
            $user->clearMediaCollection($collectionName);
            $user->uploadMedia($collectionName, $request->$collectionName, ['collection_name' => $collectionName]);
        }
        $checkAll = $request->check_all;
        if ($checkAll) {
            $checkAll = true;
        } else {
            $checkAll = false;
        }
        $attachments = $request->attachments;
        $files = $request->docs;
        $deletedFiles = $request->delete_files;

        if ($deletedFiles) {
            foreach ($deletedFiles as $file) {
                $media = Media::where('uuid', $file)->first();
                if ($media) {
                    $media->delete();
                }
            }
        }

        if ($attachments) {
            foreach ($attachments as $file) {
                $collectionName = $file['type'];
                $user->clearMediaCollection($collectionName);
                $user->uploadMedia($collectionName, $file['path'], ['collection_name' => $collectionName, 'title' => $file['title'], 'check' => $file['check']]);
            }
        }
        if ($files) {
            foreach ($files as $file) {
                $media = Media::where('uuid', $file['id'])->first();
                if ($media) {
                    $media->setCustomProperty('check', $file['check']);
                    $media->save();
                }
            }
        }

        $loginUser = Auth::user();
        $data = [
            'title' => 'Employee update',
            'message' => $loginUser->name." updated ".$user->name,
            'message_details' => 'Details',
        ];

        Helper::sendNotificationToAll($data);

        return $this->sendResponse($user, __('ApiMessage.customerUpdate'));
    }

    public function importUser(Request $request)
    {

        $input = $request->only('attachment');
        $rule = ['attachment' => 'required'];
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        if ($request->mode) {
            $mode = $request->mode;
        }
        $file = $request->file("attachment");
        
        $mimeType = $file->getMimeType();
        $acceptedMimeTypes = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        if (!in_array($mimeType, $acceptedMimeTypes)) {
            return $this->sendError('Please upload excel file only.');
        }
    
        $filepath = $file->getPathname();

        $array = (new UsersImport)->toCollection($file);

        DB::beginTransaction();
        $isAnyEntry = false;
        try {
            if ($array && $array[0]) {
                $array[0]->each(function ($user) use(&$isAnyEntry) {
                    $randomNumber = floor(rand() / getrandmax() * 10000000);

                    if(!isset($user['employee_id']) || $user['employee_id'] == '') {
                        $user['employee_id'] = $randomNumber;
                    }

                    $validate = $this->importValidation($user);

                    if($validate['status'] == false) {
                        throw new \Exception($validate['message']);
                    }
                       
                    $existUser = User::where('email', $user['email'])->orWhere('phone', $user['mobile'])->orWhere('employee_id', $user['employee_id'])->exists();
                    if (!$existUser) {
                        
                        $isAnyEntry = true;
                        
                        $jobRole = null;
                        $role = Role::where('name', $user['department'])->first();
                        if ($role) {
                            $jobRole = $role->id;
                        } else {
                            $role = Role::where('name', 'Employee')->value('id');
                            $jobRole = $role->id;
                        }
                        
						// check immediate_manager_employee_code 
						$immediate_manager = $user['immediate_manager'];
						$immediate_manager_emp_code = $user['immediate_manager_employee_code'];
						
						if($immediate_manager == '' && $immediate_manager_emp_code == ''){
							$immediate_manager_emp_code = $immediate_manager = null;
						}
						elseif(($immediate_manager == '' && $immediate_manager_emp_code != '') || ($immediate_manager != '' && $immediate_manager_emp_code == '')){
							$errorMsg = 'Immediate manager and his employee code both are required or both should be blank.';
							throw new \Exception($errorMsg);
						}
						else{
							$existUser = User::Where('employee_id', $immediate_manager_emp_code)->exists();
							$role = Role::where('name', $immediate_manager)->first();
							if (!$existUser) {
								$errorMsg = 'Immediate manager employee code "'.$immediate_manager_emp_code.'" not exist';
								throw new \Exception($errorMsg);
							} elseif (!$role) {
								$errorMsg = 'Immediate manager role "'.$immediate_manager.'" not exist';
								throw new \Exception($errorMsg);
							} else {
								$immediate_manager = $role->id;
							}
						}
						
						// check leave_approving_authority_employee_code 
						$leave_approving_authority = $user['leave_approving_authority'];
						$leave_approve_emp_code = $user['leave_approving_authority_employee_code'];
						
						if($leave_approving_authority == '' && $leave_approve_emp_code == ''){
							$leave_approve_emp_code = $leave_approving_authority = null;
						}
						elseif(($leave_approving_authority == '' && $leave_approve_emp_code != '') || ($leave_approving_authority != '' && $leave_approve_emp_code == '')){
							$errorMsg = 'Leave approving authority and his employee code both are required or both should be blank.';
							throw new \Exception($errorMsg);
						}
						else{
							$existUser = User::Where('employee_id', $leave_approve_emp_code)->exists();
							$role = Role::where('name', $leave_approving_authority)->first();
							if (!$existUser) {
								$errorMsg = 'Leave approving authority employee code "'.$leave_approve_emp_code.'" not exist';
								throw new \Exception($errorMsg);
							} elseif (!$role) {
								$errorMsg = 'Leave approving authority role "'.$leave_approving_authority.'" not exist';
								throw new \Exception($errorMsg);
							} else {
								$leave_approving_authority = $role->id;
							}
						}

                        
                        $dataToStore = [
                            'as_local' => false,
                            'first_name' => $user['first_name'],
                            'middle_name' => $user['middle_name'],
                            'last_name' => $user['last_name'],
                            'employee_id' => $user['employee_id'],
                            'email' => $user['email'],
                            'phone' => $user['mobile'],
                            'role_id' => $jobRole,
                            'password' => $user['password'],
                            'gender' => $user['gender'],
                            'dob' => Carbon::parse($user['date_of_birth']),
                            'secondary_email' => $user['secondory_email'],
                            'alternate_phone' => $user['alternate_mobile'],
                            'address' => $user['local_address_line_1'],
                            'address_1' => $user['local_address_line_2'],
                            'city' => $user['local_citytown'],
                            'state' => $user['local_state'],
                            'country' => $user['local_country'],
                            'postcode' => $user['local_post_code'],
                            'p_address' => $user['permanent_address_line_1'],
                            'p_address_1' => $user['permanent_address_line_2'],
                            'p_city' => $user['permanent_citytown'],
                            'p_state' => $user['permanent_state'],
                            'p_country' => $user['permanent_country'],
                            'p_postcode' => $user['permanent_post_code'],
                            'doj' => Carbon::parse($user['date_of_joining']),
                            'prob_end_date' => Carbon::parse($user['probation_end_date']),
                            'company' => $user['company'],
                            'location' => $user['location'],
                            'qualification' => $user['qualification_degree'],
                            'experience' => $user['work_experience'],
                            'immediate_manager' => $immediate_manager,
                            'immediate_manager_code' => $immediate_manager_emp_code,
                            'leave_approving_auth' => $leave_approving_authority,
                            'leave_approving_code' => $leave_approve_emp_code,
                            'department' => $user['department'],
                            'job_role' => $user['job_role'],
                            'grade' => $user['grade'],
                            'employment_type' => $user['employement_type'],
                            'aadhar_number' => $user['aadhar_number'],
                            'pan_number' => $user['pan_number'],
                            'epf' => $user['epf_number'],
                            'esi' => $user['esi_number'],
                            'holiday_year' => $user['holiday_year'],
                            'work_pattern' => $user['work_pattern'],
                            'earning_leave_entitlement' => is_numeric($user['annual_earned_leave_entilement']) ? $user['annual_earned_leave_entilement'] : 0,
                            'this_year' => is_numeric($user['this_year']) ? $user['this_year'] : 0, 
                            'next_year' => is_numeric($user['next_year']) ? $user['next_year'] : 0,
                            'salary' => is_numeric($user['salary']) ? $user['salary'] : 0,
                        ];
    
                        $userData = $this->userRepository->create($dataToStore);
    
                        if ($role) {
                            $userData->assignRole([$role->id]);
                        }
    
                        $userData->info()->create($dataToStore);
                    }
                });
            }
            
            if(!$isAnyEntry) {
                return $this->sendError('No data to available to Import. Email, Mobile and Employee ID should be unique.');
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
             return $this->sendError($e->getMessage());
            return $this->sendError('Invalid Data format');
        }

        return $this->sendResponse($array[0], 'Success');
    }

    protected function importValidation($user) {

        if(!isset($user['first_name']) || $user['first_name'] == ''){
            $errorMsg = 'First name field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }

        if(!isset($user['last_name']) || $user['last_name'] == ''){
            $errorMsg = 'Last Name field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }

        if(!isset($user['email']) || $user['email'] == ''){
            $errorMsg = 'Email field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['mobile']) || $user['mobile'] == ''){
            $errorMsg = 'Mobile field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['date_of_birth']) || $user['date_of_birth'] == ''){
            $errorMsg = 'Date of Birth field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['local_address_line_1']) || $user['local_address_line_1'] == ''){
            $errorMsg = 'Local address line 1 field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['local_address_line_2']) || $user['local_address_line_2'] == ''){
            $errorMsg = 'Local address line 2 field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['local_citytown']) || $user['local_citytown'] == ''){
            $errorMsg = 'Local City/Town field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['local_state']) || $user['local_state'] == ''){
            $errorMsg = 'Local State field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['local_country']) || $user['local_country'] == ''){
            $errorMsg = 'Local Country field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['local_post_code']) || $user['local_post_code'] == ''){
            $errorMsg = 'Local Post Code field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }

        if(!isset($user['permanent_address_line_1']) || $user['permanent_address_line_1'] == ''){
            $errorMsg = 'Permanent address line 1 field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['permanent_address_line_2']) || $user['permanent_address_line_2'] == ''){
            $errorMsg = 'Permanent address line 2 field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['permanent_citytown']) || $user['permanent_citytown'] == ''){
            $errorMsg = 'Permanent City/Town field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['permanent_state']) || $user['permanent_state'] == ''){
            $errorMsg = 'Permanent State field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['permanent_country']) || $user['permanent_country'] == ''){
            $errorMsg = 'Permanent Country field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['permanent_post_code']) || $user['permanent_post_code'] == ''){
            $errorMsg = 'Permanent Post Code field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }


        if(!isset($user['department']) || $user['department'] == ''){
            $errorMsg = 'Department field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }

        // if(!isset($user['designation']) || $user['designation'] == ''){
        //     $errorMsg = 'Designation field is required.';
        //     return ['status' => false, 'message' =>$errorMsg ];
        // }
        if(!isset($user['date_of_joining']) || $user['date_of_joining'] == ''){
            $errorMsg = 'Date of joining field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['probation_end_date']) || $user['probation_end_date'] == ''){
            $errorMsg = 'Probation End Date field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['aadhar_number']) || $user['aadhar_number'] == ''){
            $errorMsg = 'Aadhar number field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['pan_number']) || $user['pan_number'] == ''){
            $errorMsg = 'PAN Number field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['epf_number']) || $user['epf_number'] == ''){
            $errorMsg = 'EPF number field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        if(!isset($user['esi_number']) || $user['esi_number'] == ''){
            $errorMsg = 'ESI number field is required.';
            return ['status' => false, 'message' =>$errorMsg ];
        }
        return ['status' => true, 'message' => '' ];
    }

    public function exporCustomtUser(Request $request)
    {
        $params = $request->params;
        $fileType = $request->file_type;

        if(empty($params)) {
            return $this->sendError('Please select at least one Employee Management.');
        }

        $heading = [];
        if(!empty($params)) {
            foreach($params as $param) {
                if($param == 'first_name') { $heading[] = 'First Name'; }
                if($param == 'last_name') { $heading[] = 'last Name'; }
                if($param == 'email') { $heading[] = 'Email'; }
                if($param == 'secondary_email') { $heading[] = 'Secondary Email'; }
                if($param == 'phone') { $heading[] = 'Mobile'; }
                if($param == 'alternate_phone') { $heading[] = 'Alternate Mobile'; }
                if($param == 'gender') { $heading[] = 'Gender'; }
                if($param == 'dob') { $heading[] = 'Date of Birth'; }
            }
        }

        $users = $this->userRepository->getAllUsers();

        $newUsers = $users->map(function ($user) use($params) {
            $object = [];
            if(!empty($params)) {
                foreach($params as $param) {
                    if($param == 'first_name') { $object['first_name'] = $user->first_name; }
                    if($param == 'last_name') { $object['last_name'] = $user->last_name; }
                    if($param == 'email') { $object['email'] = $user->email; }
                    if($param == 'secondary_email') { $object['secondary_email'] = $user->info?->secondary_email; }
                    if($param == 'phone') { $object['phone'] = $user->phone; }
                    if($param == 'alternate_phone') { $object['alternate_phone'] = $user->info?->alternate_phone; }
                    if($param == 'gender') { $object['gender'] = $user->info?->gender; }
                    if($param == 'dob') { $object['dob'] = $user->info?->dob; }
                }
            }
            return $object;
        });

        if($fileType == 'PDF') {
            $pdf = Pdf::loadView('pdf.exportUser', ['users' => $newUsers, 'heading' => $heading, 'params' => $params]);
            $fileName = 'users_'.date('Y-m-d').'.pdf';
            $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save('uploads/users.pdf');
            return $this->sendResponse(url('/uploads/users.pdf'), 'Success');
            // return $pdf->download($fileName);
        } else {
            Excel::store(new UsersExport($newUsers, $heading), 'users.xlsx', 'public_uploads', \Maatwebsite\Excel\Excel::XLSX);
            return $this->sendResponse(url('/uploads/users.xlsx'), 'Success');
        }
    }

    public function exportUser(Request $request)
    {

        $excel[] =   [
            'First Name' => 'First',
            'Middle Name' => 'Middle',
            'Last Name' => 'Last',
            'Email' => 'user@gmail.com',
            'Secondory Email' => 'user1@gmail.com',
            'Mobile' => '1234567894',
            'Alternate Mobile' => '7894561235',
            'Gender' => 'Male',
            'Date of Birth' => '10-07-1995',
            'Password' => '123456',
            'Local Address Line 1' => 'Address 1',
            'Local Address Line 2' => 'Address 2',
            'Local City/Town' => 'Noida',
            'Local Country' => 'IN',
            'Local State' => 'UP',
            'Local Post Code' => '123456',
            'Permanent Address Line 1' => 'Address 1',
            'Permanent Address Line 2' => 'Address 2',
            'Permanent City/Town' => 'Noida',
            'Permanent Country' => 'IN',
            'Permanent State' => 'UP',
            'Permanent Post Code' => '123456',
            'Employee ID' => '',
            'Date of joining' => date('d-m-Y'),
            'Probation End Date' => date('d-m-Y'),
            'Company' => 'Company',
            'Location' => 'Location',
            'Qualification Degree' => '',
            'Work Experience' => '',
            'Immediate Manager' => '',
            'Immediate Manager Employee Code' => '',
            'Leave Approving Authority' => '',
            'Leave Approving Authority Employee Code' => '',
            'Department' => 'Employee',
            'Designation' => 'Developer',
            'Grade' => '',
            'Employement Type' => 'Regular',
            'Aadhar Number' => '',
            'PAN Number' => '',
            'EPF' => '',
            'ESI' => '',
            'Holiday Year' => '2024-2025',
            'Work Pattern' => 'Full Time',
            'Salary' => '0',
            'Annual Earned Leave Entilement' => '0',
            'This Year' => '0',
            'Next Year' => '0',
        ];
        Excel::store(new UsersExport($excel), 'users.xlsx', 'public_uploads', \Maatwebsite\Excel\Excel::XLSX);

        return $this->sendResponse(url('/uploads/users.xlsx'), 'Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, Request $request)
    {
        $input = $request->all();
        $rules = [
            'final_working_date' => 'required|after_or_equal:start_date',
        ];

        $message = [
            'final_working_date.after_or_equal' => 'Final Working date should be greater than De-Boarding date'
        ];
        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }

        $user = User::find($id);

        $this->userRepository->storeDeBoardUser($id, $input);

        $loginUser = Auth::user();
        
        $data = [
            'title' => 'Deboarded',
            'message' => $loginUser->name." Deboarded ".$user->name,
            'message_details' => 'Details',
        ];

        Helper::sendNotificationToAll($data);

        return $this->sendSuccess(__('ApiMessage.customerDelete'));
    }
}
