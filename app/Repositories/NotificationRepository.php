<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class NotificationRepository extends BaseRepository
{

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notification::class;
    }


    public function getUser($phone) {
        return User::where('phone','LIKE','%'.$phone.'%')->first();
    }

    public function getUserByExtension($userExtension) {
        return User::where('user_extension',$userExtension)->first();
    }

    public function getUserByCustomerId($customerID) {
        return User::where('customerID',$customerID)->first();
    }

    public function getUserByDidNumber($didNumber) {
        return User::where('did_number',$didNumber)->first();
    }

    public function getUserBundles() {

        $currentDate = date('Y-m-d');
        $previousDate = date('Y-m-d',strtotime('-3 days',strtotime($currentDate)));
        $nextDate = date('Y-m-d',strtotime('+7 days',strtotime($currentDate)));

        return DB::table('user_bundles')
                ->join('customers','customers.customerID','=','user_bundles.customerID')
                ->whereBetween('user_bundles.expired_at',[$previousDate,$nextDate])
                ->get();
    }

    public function getUserDid() {

        $expire = date('Y-m-d');
        $beforeExpire = date('Y-m-d',strtotime('+3 days',strtotime($expire)));
        $afterExpire = date('Y-m-d',strtotime('-7 days',strtotime($expire)));
        
        $whereIn = [$beforeExpire,$expire,$afterExpire];

        return DB::table('did_numbers')
                ->join('customers','customers.customerID','=','did_numbers.customerID')
                ->whereIn('did_numbers.renewal_date',$whereIn)
                ->select('customers.deviceToken','customers.customerID','customers.device_type','customers.device_token_voip','did_numbers.did_number','did_numbers.renewal_date')
                ->get();
    }

    public function getUserDidTest($didNumber) {
        return DB::table('did_numbers')
                ->join('customers','customers.customerID','=','did_numbers.customerID')
                ->where('did_numbers.did_number',$didNumber)
                ->select('customers.deviceToken','customers.customerID', 'customers.device_type','customers.device_token_voip','did_numbers.did_number','did_numbers.renewal_date')
                ->get();
    }

    public function getMyNotifications() {

        $user =  Auth::guard('api')->user();
        return Notification::where('notifiable_id', $user->customerID)
        ->where('notifiable_type', get_class($user))
        ->orderBy('read_at', 'asc')
        ->paginate(10);
    }
}
