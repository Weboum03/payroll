<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BatchExport;
use App\Exports\BatchUserExport;
use App\Http\Controllers\BaseController;
use App\Imports\UsersImport;
use App\Models\Payroll;
use App\Models\UserDetail;
use App\Repositories\BatchRepository;
use App\Services\Attendance\Models\AttendanceLog;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BatchController extends BaseController
{

    protected $batchRepository;

    /**
     * The user repository instance.
     *
     * @param  BatchRepository  $users
     * @return void
     */
    public function __construct(BatchRepository $batchRepository)
    {
        $this->batchRepository = $batchRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->batchRepository->listing($request);
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    public function getBatchFormUser($id, Request $request)
    {
        $users = $this->batchRepository->getBatchFormUser($id, $request);
        if($request->paginate) {
            return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
        }
        return $this->sendResponse($users,__('ApiMessage.retrievedMessage'));
    }

    public function getUsersByBatch($id, Request $request)
    {
        $users = $this->batchRepository->getUsersByBatch($id, $request);
        // $users->through(function ($user) {
        //     $user->salary = 0;
        //     $user->overtime = 0;
        //     $user->bonus = 0;
        //     $user->commission = 0;
        //     $user->deduction = 0;
        //     $user->reimbursement = 0;
        //     $user->leave_bal = 0;
        //     return $user;
        // });
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    public function getUsersByFilter($id, Request $request)
    {
        $users = $this->batchRepository->getUsersByBatch($id, $request);
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    public function importBatch($id, Request $request) {

        $input = $request->only('attachment');
        $rule = ['attachment' => 'required'];
        $validator = Validator::make($input,$rule);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $batch = $this->batchRepository->getById($id);

        if(!$batch) {
            return $this->sendError('Not found');
        }

        $mode = 'salary';
        if($request->mode) { $mode = $request->mode; }
        $file = $request->file("attachment");
        $filepath = $file->getPathname();

        $array = (new UsersImport)->toCollection($file);

        if($array && $array[0]) {
            $array[0]->each(function ($user) use($batch, $mode, $id) {
                if(array_key_exists($mode, $user->toArray())) {
                    $userData = Payroll::where('user_id', $user['unique_id'])->where('batch_id', $id)->first();
                    if($userData) {
                        if($mode == 'salary') { $payout = $user[$mode] - $userData->deduction; }
                        elseif($mode == 'deduction') { $payout = $userData->salary - $user[$mode]; }
                        elseif($mode == 'bonus') { $payout = $userData->salary + $user[$mode]; die; }
                        elseif($mode == 'commission') { $payout = $userData->salary + $user[$mode]; }
                        else { $payout = $userData->payout; }
                        if(!$user[$mode]) { $user[$mode] = 0; }
                        $batch->employee()->where('user_id', $user['unique_id'])->update([$mode => $user[$mode], 'payout'=> $payout]);
                    } 
                }
            });
        }

        return $this->sendResponse(true, 'Success');
    }

    public function exportBatch($id, Request $request) {

        $batch = $this->batchRepository->getById($id);

        if(!$batch) {
            return $this->sendError('Not found');
        }

        $mode = 'salary';
        if($request->mode) { $mode = $request->mode; }
        $users = $batch->users()->with('role', 'info')->get();

        $excel =  $users->map(function ($data) use($mode) {
            return [
                'unique_id' => $data['id'],
                'employee_id' => $data['employee_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'company' => $data['info']['company'],
                'location' => $data['info']['location'],
                $mode => $data['pivot'][$mode],
            ];
        });

        // return Excel::download(new BatchExport($excel), 'batch.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        Excel::store(new BatchExport($excel, $mode), 'batch.xlsx', 'public_uploads', \Maatwebsite\Excel\Excel::XLSX);

        return $this->sendResponse(url('/uploads/batch.xlsx'), 'Success');
    }

    public function downloadBatch($id, Request $request) {

        $batch = $this->batchRepository->getById($id);

        if(!$batch) {
            return $this->sendError('Not found');
        }

        $mode = 'salary';
        if($request->mode) { $mode = $request->mode; }
        $users = $batch->users()->with('role', 'info')->get();
        $excel =  $users->map(function ($data) use($mode, $batch) {
            return [
                'unique_id' => $data['id'],
                'employee_id' => $data['employee_id'],
                'name' => $data['name'],
                'doj' => $data['info']['doj'],
                'employment_type' => $data['info']['employment_type'],
                'role' => $data['role']['name'],
                'department' => $data['info']['department'],
                'location' => $data['info']['location'],
                'gender' => $data['info']['gender'],
                'dob' => $data['info']['dob'],
                'pan_number' => $data['info']['pan_number'],
                'month' => $batch->name,
                'actual_payble_days' => $data['pivot']['actual_payble_days'],
                'working_days' => (string)$data['pivot']['working_days'],
                'loss_pay_days' => (string)$data['pivot']['loss_pay_days'],
                'payble_days' => (string)$data['pivot']['payble_days'],
                'gross_salary' => (string)$data['pivot']['salary'],
                'deduction' => (string)$data['pivot']['deduction'],
                'net_pay' => (string)$data['pivot']['payout'],
            ];
        });

        // return $this->sendResponse($excel, 'Success');
        Excel::store(new BatchUserExport($excel), 'batch.xlsx', 'public_uploads', \Maatwebsite\Excel\Excel::XLSX);

        return $this->sendResponse(url('/uploads/batch.xlsx'), 'Success');
    }

    public function getMonthlyAttendance($userId, $start, $end)
    {
        // Generate all days in the month
        $daysInMonth = $this->getAllDaysOfMonth($start, $end);

        // Fetch attendance records for the user in the specified month
        $attendanceRecords = AttendanceLog::where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->where('type', 'in')
            ->get()
            ->keyBy('date'); // Key by date for easier lookup

        // Initialize counters
        $presentCount = 0;
        $absentCount = 0;

        // return $attendanceRecords['2024-06-28'];
        // Iterate through each day of the month
        foreach ($daysInMonth as $day) {
            $date = $day->format('Y-m-d');
            if (isset($attendanceRecords[$date])) {
                // Check the status of the attendance record for the current day
                if ($attendanceRecords[$date]->status == 'on-time' || $attendanceRecords[$date]->status == 'late') {
                    $presentCount++;
                } else {
                    $absentCount++;
                }
            } else {
                // No record means absent
                $absentCount++;
            }
        }

        return [
            'present_count' => (string)$presentCount,
            'absent_count' => (string)$absentCount,
        ];
    }

    function getAllDaysOfMonth($start, $end)
    {
        $period = CarbonPeriod::create($start, $end)->toArray();
        $weekdays = [];
        foreach ($period as $date) {
            if (!$date->isWeekend()) {
                $weekdays[] = $date;
            }
        }
        
        return $weekdays;
    }

    public function storeUsersByBatch($id, Request $request)
    {
        $batch = $this->batchRepository->getById($id);
        if(!$batch) {
            return $this->sendError('Not found');
        }

        $addedUser = 0;
        $selectedUser = $request->selected_user;
        $excludedUser = $request->excluded_user;
        if($selectedUser) {
            if($selectedUser == $excludedUser) {
                return $this->sendError('You cannot choose same employee to specific and exclude employee field');
            }
            $exits = $batch->employee()->where('user_id', $selectedUser)->exists();
            if(!$exits) {
                $user = UserDetail::where('user_id', $selectedUser)->first();
                $month = Carbon::now()->subMonth();
                $start = Carbon::parse($month)->startOfMonth();
                $end = Carbon::parse($month)->endOfMonth();
                $response = $this->getMonthlyAttendance($user->user_id, $start, $end);
                $actualPaybleDays = date('d', strtotime('last day of previous month'));
                $present = $response['present_count'];
                $absent = $response['absent_count'];
                $paybleDays = $actualPaybleDays - $absent;
                $percent = round(($paybleDays/$actualPaybleDays)*100,2);
                $payout = round(($percent/100)*$user->salary,2);
                $deduction = $user->salary - $payout;
                $dataToStore = [
                    'user_id' => $selectedUser,
                    'actual_payble_days' => $actualPaybleDays,
                    'working_days' => $present + $absent,
                    'loss_pay_days' => $absent,
                    'payble_days' => $paybleDays,
                    'salary' => $user->salary,
                    'deduction' => $deduction,
                    'payout' => $payout,
                ];
                $batch->employee()->create($dataToStore);
                $addedUser++;
            }
        } else {
            $users = $this->batchRepository->getAllUsersByBatch($id, $request);
            $users->each(function ($data) use($batch, $excludedUser, &$addedUser) {
                $exits = $batch->employee()->where('user_id', $data->id)->exists();
                if(!$exits && $excludedUser != $data->id) {
                    $user = UserDetail::where('user_id', $data->id)->first();
                    $month = Carbon::now()->subMonth();
                    $start = Carbon::parse($month)->startOfMonth();
                    $end = Carbon::parse($month)->endOfMonth();
                    $response = $this->getMonthlyAttendance($user->user_id, $start, $end);
                    $actualPaybleDays = date('d', strtotime('last day of previous month'));
                    $present = $response['present_count'];
                    $absent = $response['absent_count'];
                    $paybleDays = $actualPaybleDays - $absent;
                    $percent = round(($paybleDays/$actualPaybleDays)*100,2);
                    $payout = round(($percent/100)*$user->salary,2);
                    $deduction = $user->salary - $payout;
                    $dataToStore = [
                        'user_id' => $data->id,
                        'actual_payble_days' => $actualPaybleDays,
                        'working_days' => $present + $absent,
                        'loss_pay_days' => $absent,
                        'payble_days' => $paybleDays,
                        'salary' => $user->salary,
                        'deduction' => $deduction,
                        'payout' => $payout,
                    ];
                    $batch->employee()->create($dataToStore);
                    $addedUser++;
                }
            });
        }
        
        if($addedUser == 0) {
            return $this->sendError('Employees are not available to add in this batch');
        }
        return $this->sendResponse($addedUser.' Employees were added to the payroll batch successfully.', 'Success');
    }

    public function processBatch($id, Request $request)
    {
        $batch = $this->batchRepository->getById($id);
        if(!$batch) {
            return $this->sendError('Not found');
        }
        $batch->status = 'Processed';
        $batch->save();
        return $this->sendSuccess('Success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // $rules = [
        //     'name'    => 'required',
        // ];
        // $validator = Validator::make($input, $rules);
    
        // if ($validator->fails()) {
        //     return $this->sendError($validator->errors()->first(), $validator->errors());
        // }
        $user = $this->batchRepository->create($input);
        return $this->sendResponse($user, __('ApiMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->batchRepository->getById($id);
        return $this->sendResponse($user, __('ApiMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $user = $this->batchRepository->updateById($id, $input);
        return $this->sendResponse($user, __('ApiMessage.customerUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->batchRepository->deleteById($id);
        return $this->sendSuccess(__('ApiMessage.customerDelete'));
    }

    public function deleteUserByBatch(string $id, int $userId)
    {
        $this->batchRepository->deleteUserByBatch($id, $userId);
        return $this->sendSuccess(__('ApiMessage.customerDelete'));
    }
}
