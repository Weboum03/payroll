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

    public function listing($request)
    {
        $limit = $request->input('length', 20);
        $start = $request->input('start', 20);
        $orders = $request->order;
        $columns = $request->columns;
        $search = $request->search;
        $page = floor($start / $limit) + 1;
        $response =  $this->model->offset(20);

        // if($orders) {
        //     foreach($orders as $order) {
        //         $response->orderBy($columns[$order['column']]['data'], $order['dir']);
        //     }
        // }
        if ($search) {
            $response->where(function ($query) use ($search) {
                $query->where(DB::raw('CONCAT(`first_name`, " ",`last_name`)'), 'like', '%' . $search['value'] . '%')
                    ->orWhere('employee_id', 'like', '%' . $search['value'] . '%')
                    ->orWhere('email', 'like', '%' . $search['value'] . '%')
                    ->orWhere('phone', 'like', '%' . $search['value'] . '%');
            });
        }
        return Batch::latest()->withCount('employee')->withSum('employee as wages', 'gross_wages')->withSum('employee as deduction', 'deduction')->paginate(5);
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
        return User::doesntHave('payroll', 'or', function ($q) use($id) {
            $q->where('batch_id', $id);
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
