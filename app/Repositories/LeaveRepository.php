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
        return $this->model->where('user_id', $userId)->latest()->with('user', 'type')->get();
    }

    public function getLeaveTypes()
    {
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
        return $this->model->with('user.info', 'type')
            ->when($request->sort_column, function ($q) use($request) {
                return $q->orderBy($request->sort_column, $request->sort_order);
            }, function ($q) {
                return $q->latest();
            })
            ->when($request->user_id, function ($query) use ($request) {
                return $query->where('user_id', $request->user_id);
            })
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->date, function ($query) use ($request) {
                return $query->whereDate('from', $request->date);
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->whereHas('user', function ($q) use ($request) {
                    return $q->where(function ($q) use($request) {
                        return $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('employee_id', 'like', '%' . $request->search . '%');
                    });
                });
            })
            ->whereHas('user')->paginate($limit);
    }

    public function bulkUpdate($ids, $data)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->update($data);
    }

    public function bulkUpdateByStatus($status, $data)
    {
        return $this->model
            ->where('status', $status)
            ->update($data);
    }
}
