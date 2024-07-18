<?php

namespace App\Repositories;

use App\Models\LeaveType;
use App\Models\User;
use App\Notifications\NotifyGlobal;
use App\Notifications\Renewal;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class NotificationRepository extends BaseRepository
{

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LeaveType::class;
    }

    public function getMyNotifications() {

        $user =  Auth::user();
        return  $user->notifications()->latest()->paginate(10);
        // return  $user->readNotifications()->latest()->paginate(10);
        // return $user->notifications()->paginate(10);
        // return Notification::where('notifiable_id', $user->customerID)
        // ->where('notifiable_type', get_class($user))
        // ->orderBy('read_at', 'asc')
        // ->paginate(10);
    }
}
