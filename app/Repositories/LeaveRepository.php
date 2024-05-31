<?php

namespace App\Repositories;

use App\Models\LeaveApplication as Leave;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository.
 */
class LeaveRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Leave::class;
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
        return $this->model->latest()->with('user','type')->get();
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
