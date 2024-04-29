<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Customer;
use App\Models\Notification;
use App\Notifications\Renewal;
use App\Repositories\NotificationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Messaging\CloudMessage;

use Kreait\Firebase;

class NotificationController extends BaseController
{

    /**
     * The user repository instance.
     */
    protected $notificationRepository;
    protected $token;

    /**
     * Create a new controller instance.
     *
     * @param  NotificationRepository  $users
     * @return void
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->token = 'kiLCJzdWIiOjcsInBydiI6IjFkMGEwMjBhY2Y1YzRiNmM0OTc5ODlkZjFhYmYwZmJkNGU4YzhkNjMifQ.G5h3GC20sVfGdBWr65RK6K';
    }

    public function getMyNotifications(Request $request): JsonResponse
    {
        $notifications = $this->notificationRepository->getMyNotifications();

        return $this->sendResponseWithPagination(NotificationResource::collection($notifications), 'Notifications retrieved successfully');
       
    }

    public function markAsRead(Request $request): JsonResponse
    {

        $notification_id = $request->id;

         DB::table('notifications')->whereIn('id',$notification_id)->update(['read_at'=>Carbon::now()]);
         return $this->sendSuccess('Notifications marked as read successfully');
    }

    public function markAsReadAll(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::guard('api')->user();
        $user->unreadNotifications()->update(['read_at' => Carbon::now()]);

        return $this->sendSuccess('Notifications marked as read successfully');
    }

    public function getMyUnreadNotifications(Request $request): JsonResponse
    {
        /** @var User $user */
        $user =  Auth::guard('api')->user();
        $unreadNotifications = $user->unreadNotifications()->get();
        return $this->sendResponse(NotificationResource::collection($unreadNotifications), 'Notifications retrieved successfully');
    }

    public function getMyUnreadNotificationsCount(): JsonResponse
    {
        /** @var User $user */
        $user =  Auth::guard('api')->user();
        if(!empty($user)){
        $unreadNotificationsCount = $user->unreadNotifications()->count();
        }else{
            $unreadNotificationsCount =null;
        }

        return $this->sendResponse(NotificationResource::collection($unreadNotificationsCount), 'Notifications retrieved successfully');
    }

    public function destroy(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::guard('api')->user();

        $user->notifications()->whereIn('id', $request->id)->delete();

        return $this->sendSuccess('Notification deleted successfully');
    }
}
