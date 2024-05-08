<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends BaseController
{
    /**
     * Create a new AdminAuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:adminApi', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (! $token = Auth::guard('adminApi')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email'    => 'unique:admins|required',
            'password' => 'required',
        ];
    
        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors());
        }

        Admin::create($input);

        return $this->sendSuccess(__('ApiMessage.register'));
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->sendResponse(auth()->guard('adminApi')->user(),__('ApiMessage.retrievedMessage'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->sendResponse(auth()->guard('adminApi')->user(),__('ApiMessage.logout'));
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->sendResponse(auth()->guard('adminApi')->refresh(),__('ApiMessage.success'));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = Auth::guard('adminApi')->user();
        return response()->json([
            'id'  => $user->id,
            'name'  => $user->name,
            'email'  => $user->email,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
