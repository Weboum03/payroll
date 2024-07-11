<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\LeaveApplication;
use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveController extends BaseController
{
    protected $leaveRepository;

    /**
     * The user repository instance.
     *
     * @param  LeaveRepository  $users
     * @return void
     */
    public function __construct(LeaveRepository $leaveRepository)
    {
        $this->leaveRepository = $leaveRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leaves = $this->leaveRepository->listing($request);
        $leaves->through(function ($leave) {
            $user = $leave->user;
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url)??null);
            $user->makeHidden('media');
            return $leave;
        });
        return $this->sendResponseWithPagination($leaves,__('ApiMessage.retrievedMessage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'leave_type_id'    => 'required',
            'reason'    => 'required',
        ];

        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }

        $user = Auth::user();
        $userInfo = $user->info;
        $leave = new LeaveApplication();
        $input['user_id'] = $user->id;
        $leave->fill($input);
        $leave->leave_count = $leave->duration;
        if($leave->duration > $userInfo->earning_leave_entitlement) {
            return $this->sendError('You have insufficient Earned Leave');
        }
        $leave->save();
        $userInfo->decrement('earning_leave_entitlement', $leave->duration);
        
        return $this->sendResponse($leave, __('ApiMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = $this->leaveRepository->getById($id);
        return $this->sendResponse($leave, __('ApiMessage.retrievedMessage'));
    }

    /**
     * Display the specified resource by user
     */
    public function getByUser(int $userId)
    {
        $leave = $this->leaveRepository->getByUserId($userId);
        return $this->sendResponse($leave, __('ApiMessage.retrievedMessage'));
    }

    public function getLeaveTypes()
    {
        $leave = $this->leaveRepository->getLeaveTypes();
        return $this->sendResponse($leave, __('ApiMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $leave = $this->leaveRepository->getById($id);
        $oldStatus = $leave->status;
        $leave->fill($input);
        if($leave->isDirty('status')) {
            if($oldStatus == 'Rejected') {
                return $this->sendError('Request rejected already cannot change status now');
            }
            if($leave->status == 'Rejected') {
                $leave->user->info()->increment('earning_leave_entitlement', $leave->duration);
            }
        }
        $leave->save();
        return $this->sendResponse($leave, __('ApiMessage.success'));
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->ids;
        $status = $request->status;
        $reason = $request->reason. ' ';
        $filterStatus = $request->filter_status;
        $checkAll = $request->check_all;

        if($checkAll) {
            $this->leaveRepository->bulkUpdateByStatus($filterStatus,['status' => $status, 'reason' => $reason] );
        } else {
            $this->leaveRepository->bulkUpdate($ids,['status' => $status, 'reason' => $reason] );
        }
        
        
        return $this->sendResponse([], __('ApiMessage.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->leaveRepository->deleteById($id);
        return $this->sendSuccess(__('ApiMessage.customerDelete'));
    }
}
