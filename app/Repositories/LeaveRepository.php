<?php

namespace App\Repositories;

use App\Models\LeaveApplication as Leave;
use App\Models\LeaveType;
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
        return $this->model->where('user_id', $userId)->latest()->with('user','type')->get();
    }

    public function getLeaveTypes() {
        return LeaveType::all();
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
        $limit = $request->input('limit', 10);
        return $this->model->latest()->with('user.info','type')
        ->when($request->user_id, function ($query) use($request) {
            return $query->where('user_id', $request->user_id);
        })
        ->when($request->status, function ($query) use($request) {
            return $query->where('status', $request->status);
        })
        ->when($request->date, function ($query) use($request) {
            return $query->whereDate('from', $request->date);
        })
        ->when($request->search, function ($query) use($request) {
            return $query->whereHas('user', function ($q) use($request) {
                return $q->where('name', 'LIKE', "%$request->search%");
            });
        })
        ->whereHas('user')->paginate($limit);
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
