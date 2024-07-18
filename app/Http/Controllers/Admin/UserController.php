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
            $user->setAttribute($collectionName, ($picture->original_url) ?? null);
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
        $filepath = $file->getPathname();

        $array = (new UsersImport)->toCollection($file);

        DB::beginTransaction();

        try {
            if ($array && $array[0]) {
                $array[0]->each(function ($user) {
                    $randomNumber = floor(rand() / getrandmax() * 10000000);
                    if($user['employee_id'] == '') {
                        $user['employee_id'] = $randomNumber;
                    }
                    $existUser = User::where('email', $user['email'])->orWhere('phone', $user['mobile'])->orWhere('employee_id', $user['employee_id'])->exists();
                    if (!$existUser) {
                        $jobRole = null;
                        $role = Role::where('name', $user['job_role'])->first();
                        if ($role) {
                            $jobRole = $role->id;
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
                            'immediate_manager' => $user['immediate_manager'],
                            'immediate_manager_code' => $user['immediate_manager_employee_code'],
                            'leave_approving_auth' => $user['leave_approving_authority'],
                            'leave_approving_code' => $user['leave_approving_authority_employee_code'],
                            'department' => $user['department'],
                            'job_role' => $user['job_role'],
                            'grade' => $user['grade'],
                            'employment_type' => $user['employement_type'],
                            'aadhar_number' => $user['aadhar_number'],
                            'pan_number' => $user['pan_number'],
                            'holiday_year' => $user['holiday_year'],
                            'work_pattern' => $user['work_pattern'],
                            'earning_leave_entitlement' => $user['annual_earned_leave_entilement'],
                            'this_year' => $user['this_year'],
                            'next_year' => $user['next_year'],
                            'salary' => $user['salary'],
                        ];
    
                        $userData = $this->userRepository->create($dataToStore);
    
                        if ($role) {
                            $userData->assignRole([$role->id]);
                        }
    
                        $userData->info()->create($dataToStore);
                    }
                });
            }
        
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            // return $this->sendError($e->getMessage());
            return $this->sendError('Invalid Data format');
        }

        return $this->sendResponse($array[0], 'Success');
    }

    public function exporCustomtUser(Request $request)
    {
        $params = $request->params;

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
                if($param == 'alternate_mobile') { $heading[] = 'Alternate Mobile'; }
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
                    if($param == 'alternate_mobile') { $object['alternate_mobile'] = $user->info?->alternate_phone; }
                    if($param == 'gender') { $object['gender'] = $user->info?->gender; }
                    if($param == 'dob') { $object['dob'] = $user->info?->dob; }
                }
            }
            return $object;
        });

        Excel::store(new UsersExport($newUsers, $heading), 'users.xlsx', 'public_uploads', \Maatwebsite\Excel\Excel::XLSX);

        return $this->sendResponse(url('/uploads/users.xlsx'), 'Success');
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
            'Local City/Town' => 'City',
            'Local Country' => 'India',
            'Local State' => 'State',
            'Local Post Code' => '123456',
            'Permanent Address Line 1' => 'Address 1',
            'Permanent Address Line 2' => 'Address 2',
            'Permanent City/Town' => 'City',
            'Permanent Country' => 'India',
            'Permanent State' => 'State',
            'Permanent Post Code' => '123456',
            'Employee ID' => '',
            'Date of joining' => '2024-01-01',
            'Probation End Date' => '2024-01-01',
            'Company' => 'Company',
            'Location' => 'Location',
            'Qualification Degree' => '',
            'Work Experience' => '',
            'Immediate Manager' => '',
            'Immediate Manager Employee Code' => '',
            'Leave Approving Authority' => '',
            'Leave Approving Authority Employee Code' => '',
            'Department' => '',
            'Job Role' => 'User',
            'Grade' => '',
            'Employement Type' => 'Regular',
            'Aadhar Number' => '',
            'PAN Number' => '',
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
