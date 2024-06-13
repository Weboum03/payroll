<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Contracts\Auth\Guard;
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



Route::group(['prefix' => 'auth'], function ($router) {
    $router->post('login', [AdminAuthController::class, 'login']);
    $router->post('register', [AdminAuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:api'], function ($router) {
    $router->post('logout', [AdminAuthController::class, 'logout']);
    $router->post('refresh', [AdminAuthController::class, 'refresh']);
    $router->get('user', [AdminAuthController::class, 'me']);
    $router->get('role-list', [RoleController::class, 'getList']);
    $router->get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    $router->put('role-permissions', [PermissionController::class, 'updateRolePermissions']);
    $router->apiResource('permissions', PermissionController::class);
    $router->apiResource('roles', RoleController::class);
    $router->apiResource('users', UserController::class);
    $router->apiResource('batches', BatchController::class);
    $router->get('batches/{id}/users', [BatchController::class, 'getUsersByBatch']);
    $router->put('batches/{id}/users', [BatchController::class, 'storeUsersByBatch']);
    $router->put('batches/{id}/process', [BatchController::class, 'processBatch']);
    $router->put('batches/{id}/export', [BatchController::class, 'exportBatch']);
    $router->post('batches/{id}/import', [BatchController::class, 'importBatch']);
    $router->delete('batches/{id}/users/{userId}', [BatchController::class, 'deleteUserByBatch']);
    $router->apiResource('leaves', LeaveController::class);
    $router->get('leaves/user/{userId}', [LeaveController::class, 'getByUser']);
    $router->get('abilities', function(Request $request) {
        return Auth::user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});
