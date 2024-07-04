<?php

namespace App\Repositories;

use App\Models\Batch;
use App\Models\Deboard;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
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

    public function getDashboardInfo($request) {

        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get the previous month and year
        $previousMonth = Carbon::now()->subMonth();
        $previousMonthNumber = $previousMonth->month;
        $previousMonthYear = $previousMonth->year;

        // Count users created in the current month
        $usersCount = User::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $usersNewJoinCount = UserDetail::whereYear('doj', $currentYear)
            ->whereMonth('doj', $currentMonth)
            ->count();
        
        // Count users created in the previous month
        $previousUsersCount = User::whereYear('created_at', $previousMonthYear)
            ->whereMonth('created_at', $previousMonthNumber)
            ->count();

        
        
        $previousUsersNewJoinCount = UserDetail::whereYear('doj', $previousMonthYear)
            ->whereMonth('doj', $previousMonthNumber)
            ->count();

        $batchCount = Batch::where('status', 'Processed')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();

        $batchPendingCount = Batch::where('status', 'Generated')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();
        $lastMonth = [
            'name' => 'June 2024',
            'employees' => $previousUsersCount,
            'new_starter' => $previousUsersNewJoinCount,
            'leaver' => 0,
            'on_notice_period' => 0
        ];

        $currentMonth = [
            'name' => 'July 2024',
            'employees' => $usersCount,
            'new_starter' => $usersNewJoinCount,
            'leaver' => 0,
            'on_notice_period' => 0
        ];

        return [
            'batch_processed' => $batchCount,
            'batch_pending' => $batchPendingCount,
            'last_month' => $lastMonth,
            'current_month' => $currentMonth,
        ];
    }

    public function listing($request)
    {
        return $this->model->latest()->with('role')
        ->whereHas('info', function ($query) use($request) {
            $query->when($request->company, function ($q) use($request) {
                return $q->where('company', $request->company);
            })
            ->when($request->location, function ($q) use($request) {
                return $q->where('location', $request->location);
            })
            ->when($request->department, function ($q) use($request) {
                return $q->where('department', $request->department);
            })
            // ->when($request->job_role, function ($q) use($request) {
            //     return $q->where('job_role', $request->job_role);
            // })
            ->when($request->gender, function ($q) use($request) {
                return $q->where('gender', $request->gender);
            })
            ->when($request->employment_type, function ($q) use($request) {
                return $q->where('employment_type', $request->employment_type);
            });
        })
        ->when($request->role, function ($q) use($request) {
            return $q->where('role_id', $request->role);
        })
        ->get();
    }

    public function listingPaginate($request)
    {
        return $this->model->latest()->with('role','info')
        ->whereHas('info', function ($query) use($request) {
            $query->when($request->company, function ($q) use($request) {
                return $q->where('company', $request->company);
            })
            ->when($request->location, function ($q) use($request) {
                return $q->where('location', $request->location);
            })
            ->when($request->department, function ($q) use($request) {
                return $q->where('department', $request->department);
            })
            // ->when($request->job_role, function ($q) use($request) {
            //     return $q->where('job_role', $request->job_role);
            // })
            ->when($request->gender, function ($q) use($request) {
                return $q->where('gender', $request->gender);
            })
            ->when($request->employment_type, function ($q) use($request) {
                return $q->where('employment_type', $request->employment_type);
            });
        })
        ->when($request->search, function ($query) use($request) {
            return $query->where('name', 'LIKE', "%$request->search%");
        })
        ->when($request->role, function ($q) use($request) {
            return $q->where('role_id', $request->role);
        })
        ->paginate(10);
    }

    public function getDashboardUser($request)
    {
        if($request->month == 6) {
            // Get the previous month and year
            $previousMonth = Carbon::now()->subMonth();
            $month = $previousMonth->month;
            $year = $previousMonth->year;
        } else {
            // Get the current month and year
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
        }

        return $this->model->latest()->with('role','info')
        ->when($request->type == 'employees', function ($q) use($request, $year, $month) {
            return $q->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);
        })
        ->whereHas('info', function ($query) use($request, $year, $month) {
            $query->when($request->type == 'new_starter', function ($q) use($request, $year, $month) {
                return $q->whereYear('doj', $year)
                ->whereMonth('doj', $month);
            })
            ->when($request->type == 'leaver' || $request->type == 'on_notice_period', function ($q) use($request) {
                return $q->where('location', 'rgregre');
            })
            ->when($request->department, function ($q) use($request) {
                return $q->where('department', $request->department);
            })
            ->when($request->gender, function ($q) use($request) {
                return $q->where('gender', $request->gender);
            })
            ->when($request->employment_type, function ($q) use($request) {
                return $q->where('employment_type', $request->employment_type);
            });
        })
        ->when($request->search, function ($query) use($request) {
            return $query->where('name', 'LIKE', "%$request->search%");
        })
        ->when($request->role, function ($q) use($request) {
            return $q->where('role_id', $request->role);
        })
        ->paginate(10);
    }

    public function checkDocument($type, $value, $userId = null) {

        if($type == 'email' || $type == 'phone') {
            return User::where($type, $value)
            ->when($userId, function ($q) use($userId) {
                return $q->where('id', '<>', $userId);
            })
            ->exists();
        }
        return UserDetail::where($type, $value)
        ->when($userId, function ($q) use($userId) {
            return $q->where('user_id', '<>', $userId);
        })
        ->exists();
    }

    public function storeDeBoardUser($id, $data) {
        $data['user_id'] = $id;
        $data['re_employable'] = false;
        return Deboard::create($data);
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
