<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['middleware' => 'admin','prefix' => 'auth'], function ($router) {
    $router->post('login', [AdminAuthController::class, 'login']);
    $router->post('register', [AdminAuthController::class, 'register']);
    $router->post('logout', [AdminAuthController::class, 'logout']);
    $router->post('refresh', [AdminAuthController::class, 'refresh']);
    $router->post('me', [AdminAuthController::class, 'me']);
});

Route::group(['middleware' => 'admin'], function ($router) {
    $router->apiResource('users', UserController::class);
    $router->apiResource('payroll_batch', BatchController::class);
    $router->get('abilities', function(Request $request) {
        //return Auth::guard('adminApi')->user();
        return Auth::guard('adminApi')->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});
