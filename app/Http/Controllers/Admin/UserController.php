<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
            $user->setAttribute('user_profile_picture', ($picture->preview_url)??null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponse($users,__('ApiMessage.retrievedMessage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'email'    => 'unique:users|required',
            'employee_id'    => 'unique:users|required',
        ];
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }
        $user = $this->userRepository->create($input);

        $user->info()->create($input);

        $role = Role::find($request->role_id);
        if($role) {
            $user->assignRole([$role->id]);
            $user->role_id = $role->id;
            $user->save();
        }

        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            if (!$request->has($collectionName)) { continue; }
            $user->uploadMedia($collectionName, $request->$collectionName);
        }
        
        return $this->sendResponse($user, __('AdminMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->getById($id);
        $user->load('info');
        $picture = $user->getFirstMediaUrl('user_profile_picture');
        $user->setAttribute('user_profile_picture', $picture);
        $user->makeHidden('media');
        return $this->sendResponse($user, __('AdminMessage.retrievedMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $user = $this->userRepository->updateById($id, $input);
        $user->info()->updateOrCreate(['user_id' => $id], $input);
        $role = Role::find($request->role_id);
        if($role) {
            $user->assignRole([$role->id]);
            $user->role_id = $role->id;
            $user->save();
        }
        
        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            if (!$request->has($collectionName)) { continue; }
            if($collectionName == 'user_profile_picture') { $user->clearMediaCollection($collectionName); }
            $user->uploadMedia($collectionName, $request->$collectionName);
        }
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
