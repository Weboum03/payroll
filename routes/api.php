<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

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
    $router->post('login', [AuthController::class, 'login']);
    $router->post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:api'], function ($router) {
    $router->post('logout', [AuthController::class, 'logout']);
    $router->post('refresh', [AuthController::class, 'refresh']);
    $router->get('user', [AuthController::class, 'me']);

    //Notification
    $router->get('notifications/{notification_id}', [NotificationController::class, 'show']);
    $router->get('my_notifications', [NotificationController::class, 'getMyNotifications']);
    $router->post('my_notifications/read', [NotificationController::class, 'markAsRead']);
    $router->post('my_notifications/read_all', [NotificationController::class, 'markAsReadAll']);
    $router->get('my_notifications/unread', [NotificationController::class, 'getMyUnreadNotifications']);
    $router->get('my_notifications/unread_count', [NotificationController::class, 'getMyUnreadNotificationsCount']);
    $router->post('delete_notification', [NotificationController::class, 'destroy']);
});
