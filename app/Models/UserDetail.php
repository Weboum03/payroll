<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $appends = ['employment_duration'];

    protected $fillable = [
        'gender',
        'dob',
        'secondary_email',
        'alternate_phone',
        'as_local',
        'address',
        'address_1',
        'city',
        'state',
        'country',
        'postcode',
        'p_address',
        'p_address_1',
        'p_city',
        'p_state',
        'p_country',
        'p_postcode',
        'doj',
        'prob_end_date',
        'company',
        'location',
        'qualification',
        'experience',
        'immediate_manager',
        'immediate_manager_code',
        'leave_approving_auth',
        'leave_approving_code',
        'department',
        'job_role',
        'grade',
        'employment_type',
        'aadhar_number',
        'pan_number',
        'holiday_year',
        'work_pattern',
        'earning_leave_entitlement',
        'this_year',
        'next_year',
        'check_all',
        'salary'
    ];

    protected $casts = [
        'as_local' => 'boolean',
        'check_all' => 'boolean'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getEmploymentDurationAttribute()
    {
        $date1 = new Carbon($this->prob_end_date);

        $date2 = new Carbon($this->doj);

        $diff = $date1->diff($date2);

        // Extract months and days from the difference
        $months = $diff->m + ($diff->y * 12);
        $days = $diff->d;

        return ['months' => $months, 'days' => $days];
    }
}
