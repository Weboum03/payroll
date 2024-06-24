<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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
            $user->setAttribute('user_profile_picture', ($picture->original_url)??null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponse($users,__('ApiMessage.retrievedMessage'));
    }

    public function getUserPaginate(Request $request)
    {
        $users = $this->userRepository->listingPaginate($request);
        $users->through(function ($user) {
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url)??null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponseWithPagination($users,__('ApiMessage.retrievedMessage'));
    }

    public function getReportUsers(Request $request)
    {
        $users = $this->userRepository->listing($request);
        $users->map(function ($user) {
            $picture = $user->getFirstMedia('user_profile_picture');
            $user->setAttribute('user_profile_picture', ($picture->original_url)??null);
            $user->makeHidden('media');
            return $user;
        });
        return $this->sendResponse($users,__('ApiMessage.retrievedMessage'));
    }

    public function checkDocument($type, Request $request)
    {
        $check = $this->userRepository->checkDocument($type, $request->value, $request->user_id);
        if($type == 'pan_number') { $message = 'This PAN number already exists'; }
        elseif($type == 'aadhar_number') { $message = 'This aadhar number already exists'; }
        else { $message = 'Already exist'; }
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
        if($checkAll == 'true') { $checkAll = true; } elseif($checkAll == 'false') { $checkAll = false; }
        if($checkAll) { $checkAll = true; } else { $checkAll = false; }
        $input['check_all'] = $checkAll;

        $user->info()->create($input);

        $role = Role::find($request->role_id);
        if($role) {
            $user->assignRole([$role->id]);
            $user->role_id = $role->id;
            $user->save();
        }

        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            if (!$request->has($collectionName)) { continue; }
            $user->uploadMedia($collectionName, $request->$collectionName, ['collection_name' => $collectionName]);
        }

        
        $attachments = $request->attachments;
        if($attachments) {
            foreach ($attachments as $file) {
                $collectionName = $file['type'];
                $user->clearMediaCollection($collectionName);
                $user->uploadMedia($collectionName, $file['path'], ['collection_name' => $collectionName, 'title' => $file['title'],'check' => $file['check']]);
            }
        }
        
        return $this->sendResponse($user, __('ApiMessage.customerAdd'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->getById($id);
        $user->load('info','role');

        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            $picture = $user->getFirstMedia($collectionName);
            $user->setAttribute($collectionName, ($picture->original_url)??null);
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
        if($role) {
            $user->syncRoles($role);
            $user->role_id = $role->id;
            $user->save();
        }
        
        foreach (User::MEDIA_COLLECTIONS as $collectionName) {
            if (!$request->has($collectionName)) { continue; }
            $user->clearMediaCollection($collectionName);
            $user->uploadMedia($collectionName, $request->$collectionName, ['collection_name' => $collectionName]);
        }
        $checkAll = $request->check_all;
        if($checkAll) { $checkAll = true; } else { $checkAll = false; }
        $attachments = $request->attachments;
        $files = $request->docs;
        $deletedFiles = $request->delete_files;

        if($deletedFiles) {
            foreach($deletedFiles as $file) {
                $media = Media::where('uuid',$file)->first();
                if($media) {
                    $media->delete();
                }
            }
        }
        
        if($attachments) {
            foreach ($attachments as $file) {
                $collectionName = $file['type'];
                $user->clearMediaCollection($collectionName);
                $user->uploadMedia($collectionName, $file['path'], ['collection_name' => $collectionName, 'title' => $file['title'], 'check' => $file['check']]);
            }
        }
        if($files) {
            foreach($files as $file) {
                $media = Media::where('uuid',$file['id'])->first();
                if($media) {
                    $media->setCustomProperty('check', $file['check']);
                    $media->save();
                }
            }
        }

        return $this->sendResponse($user, __('ApiMessage.customerUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $input = $request->all();
        $rules = [
            'final_working_date' => 'required|after:start_date',
        ];

        $message = [
            'final_working_date.after' => 'Final Working date should be greater than De-Boarding date'
        ];
        $validator = Validator::make($input, $rules, $message);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }
        $this->userRepository->deleteById($id);
        return $this->sendSuccess(__('ApiMessage.customerDelete'));
    }
}
