<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
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
        $leaves->map(function ($leave) {
            $user = $leave->user;
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url)??null);
            $user->makeHidden('media');
            return $leave;
        });
        return $this->sendResponse($leaves,__('ApiMessage.retrievedMessage'));
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
        $input['user_id'] = Auth::id();
        $leave = $this->leaveRepository->create($input);
        
        return $this->sendResponse($leave, __('AdminMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = $this->leaveRepository->getById($id);
        return $this->sendResponse($leave, __('AdminMessage.retrievedMessage'));
    }

    /**
     * Display the specified resource by user
     */
    public function getByUser(int $userId)
    {
        $leave = $this->leaveRepository->getByUserId($userId);
        return $this->sendResponse($leave, __('AdminMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $leave = $this->leaveRepository->updateById($id, $input);
        return $this->sendResponse($leave, __('AdminMessage.customerUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->leaveRepository->deleteById($id);
        return $this->sendSuccess(__('AdminMessage.customerDelete'));
    }
}
