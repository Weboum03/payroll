<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'email'    => 'unique:users|required',
        ];
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }
        $user = $this->userRepository->create($input);
        return $this->sendResponse($user, __('AdminMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->getById($id);
        return $this->sendResponse($user, __('AdminMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $user = $this->userRepository->updateById($id, $input);
        return $this->sendResponse($user, __('AdminMessage.customerUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userRepository->deleteById($id);
        return $this->sendSuccess(__('AdminMessage.customerDelete'));
    }
}
