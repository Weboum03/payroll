<?php

namespace App\Repositories;

use App\Models\Batch;
use App\Models\Payroll;
use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository.
 */
class BatchRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Batch::class;
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

    public function getBatchFormUser($batchId, $request)
    {
        return User::latest()->with('role')
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
            ->when($request->gender, function ($q) use($request) {
                return $q->where('gender', $request->gender);
            })
            ->when($request->employment_type, function ($q) use($request) {
                return $q->where('employment_type', $request->employment_type);
            });
        })
        ->whereDoesntHave('payroll', function ($q) use($batchId) {
            // return $q->where('batch_id', $batchId);
        })
        ->when($request->role, function ($q) use($request) {
            return $q->where('role_id', $request->role);
        })
        ->when($request->paginate , function ($q) { return $q->paginate(10); }, function ($q) { return $q->get(); });
    }

    public function listing($request)
    {
        $limit = $request->input('limit', 5);
        return Batch::latest()->withCount('employee')->withSum('employee as wages', 'salary')
        ->when($request->search, function ($q) use($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })
        ->withSum('employee as deduction', 'deduction')->withSum('employee as payout', 'payout')->paginate($limit);
    }

    public function getUsersByBatch($id, $request)
    {
        $batch = Batch::find($id);
        if ($batch) {
            return $batch->users()->with('role', 'info')
                ->whereHas('info', function ($query) use ($request) {
                    $query->when($request->company, function ($q) use ($request) {
                        return $q->where('company', $request->company);
                    })
                        ->when($request->location, function ($q) use ($request) {
                            return $q->where('location', $request->location);
                        })
                        ->when($request->department, function ($q) use ($request) {
                            return $q->where('department', $request->department);
                        })
                        // ->when($request->job_role, function ($q) use($request) {
                        //     return $q->where('job_role', $request->job_role);
                        // })
                        ->when($request->gender, function ($q) use ($request) {
                            return $q->where('gender', $request->gender);
                        });
                    // ->when($request->employment_type, function ($q) use($request) {
                    //     return $q->where('employment_type', $request->employment_type);
                    // });

                })
                ->when($request->search, function ($q) use($request) {
                    return $q->where(function ($q) use($request) {
                        return $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('employee_id', 'like', '%' . $request->search . '%');
                    });
                })
                ->paginate(10);
        }
        return [];
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    dd($row); //$header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function getAllUsersByBatch($id, $request)
    {
        return User::whereDoesntHave('payroll', function ($q) use($id) {
            // return $q->where('batch_id', $id);
        })->with('info')->whereHas('info', function ($query) use ($request) {
            $query->when($request->company, function ($q) use ($request) {
                return $q->where('company', $request->company);
            })
                ->when($request->location, function ($q) use ($request) {
                    return $q->where('location', $request->location);
                })
                ->when($request->department, function ($q) use ($request) {
                    return $q->where('department', $request->department);
                })
                // ->when($request->job_role, function ($q) use($request) {
                //     return $q->where('job_role', $request->job_role);
                // })
                ->when($request->gender, function ($q) use ($request) {
                    return $q->where('gender', $request->gender);
                });
            // ->when($request->employment_type, function ($q) use($request) {
            //     return $q->where('employment_type', $request->employment_type);
            // });

        })->get();
    }


    public function deleteUserByBatch($id, $userId)
    {
        return Payroll::where('batch_id', $id)->where('user_id', $userId)->delete();
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
