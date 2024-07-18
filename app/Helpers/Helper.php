<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\User;
use App\Notifications\NotifyGlobal;
use Spatie\Permission\Models\Role;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function sendNotificationToAll($data) {
        $rolesIds = Role::whereIn('name', ['Admin', 'Supervisor', 'Manager', 'Superuser'])->pluck('id');
        
        $users = User::whereIn('role_id', $rolesIds)->get();

        $users->each(function ($user) use($data) {
            $user->notify(new NotifyGlobal($data));
        });
    }
}