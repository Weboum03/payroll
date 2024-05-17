<?php

namespace App\Repositories;

use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function getByUserId(int $userId): Collection
    {
        return $this->model->where('id', $userId)->get();
    }

    public function getByPhone(string $phone)
    {
        return $this->model
            ->where('phone', $phone)
            ->select('uniquecode', 'phone', 'email', 'country', 'credit')
            ->first();
    }

    public function getByEmail(string $email)
    {
        return $this->model
            ->where('email', $email)
            ->orWhere('phone', $email)
            ->select('customerID', 'uniquecode', 'phone', 'email', 'country', 'currency', 'user_extension', 'credit', 'user_extension as sipUsername', 'domain as sipDomain', 'password as sipPassword')
            ->first();
    }

    public function listing($request)
    {
        $limit = $request->input('length', 20);
        $start = $request->input('start', 20);
        $orders = $request->order;
        $columns = $request->columns;
        $search = $request->search;
        $page = floor($start/$limit) + 1;
        return $this->model->latest()->with('role')->paginate($limit);
        
        // if($orders) {
        //     foreach($orders as $order) {
        //         $response->orderBy($columns[$order['column']]['data'], $order['dir']);
        //     }
        // }
        // if($search) {
        //     $response->where(function ($query) use($search) {
        //         $query->where(DB::raw('CONCAT(`first_name`, " ",`last_name`)'), 'like', '%' . $search['value'] . '%')
        //            ->orWhere('employee_id', 'like', '%' . $search['value'] . '%')
        //            ->orWhere('email', 'like', '%' . $search['value'] . '%')
        //            ->orWhere('phone', 'like', '%' . $search['value'] . '%');
        //     });
        // }
        return $response->latest()->paginate($limit, ['*'], 'page', $page);
    }

    public function updatePassword($data)
    {

        return $this->model
            ->where('uniquecode', $data['uniquecode'])
            ->update(['password' => Hash::make($data['password'])]);
    }

    public function changePassword($data)
    {
        return $this->model
            ->where('customerID', auth()->user()->customerID)
            ->update(['password' => Hash::make($data['password'])]);
    }
}
