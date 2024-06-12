<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\UserDetail;
use App\Repositories\BatchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function getUsersByBatch($id, Request $request)
    {
        $users = $this->batchRepository->getUsersByBatch($id, $request);
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    public function getUsersByFilter($id, Request $request)
    {
        $users = $this->batchRepository->getUsersByBatch($id, $request);
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    public function storeUsersByBatch($id, Request $request)
    {
        $batch = $this->batchRepository->getById($id);
        if(!$batch) {
            return $this->sendError('Not found');
        }

        $selectedUser = $request->selected_user;
        $excludedUser = $request->excluded_user;
        if($selectedUser) {
            $exits = $batch->employee()->where('user_id', $selectedUser)->exists();
            if(!$exits) {
                $user = UserDetail::where('user_id', $selectedUser)->first();
                $batch->employee()->create(['user_id' => $selectedUser, 'gross_wages' => $user->salary]);
            }
        } else {
            $users = $this->batchRepository->getAllUsersByBatch($id, $request);
            $users->each(function ($user) use($batch, $excludedUser) {
                $exits = $batch->employee()->where('user_id', $user->id)->exists();
                if(!$exits && $excludedUser != $user->id) {
                    $batch->employee()->create(['user_id' => $user->id, 'gross_wages' => $user->info->salary]);
                }
            });
        }
        
        return $this->sendSuccess('Success');
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
        return $this->sendResponse($user, __('AdminMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->batchRepository->getById($id);
        return $this->sendResponse($user, __('AdminMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $user = $this->batchRepository->updateById($id, $input);
        return $this->sendResponse($user, __('AdminMessage.customerUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->batchRepository->deleteById($id);
        return $this->sendSuccess(__('AdminMessage.customerDelete'));
    }

    public function deleteUserByBatch(string $id, int $userId)
    {
        $this->batchRepository->deleteUserByBatch($id, $userId);
        return $this->sendSuccess(__('AdminMessage.customerDelete'));
    }
}
