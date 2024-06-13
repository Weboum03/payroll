<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $table = 'leave_applications';

    protected $fillable = [
        'user_id',
        'reason',
        'remarks',
        'applier_user_id',
        'from_type',
        'from',
        'to_type',
        'to',
        'leave_type_id',
        'status'
    ];

    protected $casts = [
        'from' => 'date',
    ];

    protected $appends = ['duration'];

    public function applier()
    {
        return $this->hasOne(User::class, 'id', 'applier_user_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function type() {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }

    public function getFromAttribute($value)
    {
        return (new Carbon($value))->toFormattedDateString();
    }
    public function getToAttribute($value)
    {
        return ($value) ? (new Carbon($value))->toFormattedDateString() : $value;
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->format('d/m/Y g:i A');
    }

    public function getDurationAttribute()
    {
        return (new Carbon($this->to))->diffInDays(new Carbon($this->from))+1;
    }

    public function scopeMyApplications($query)
    {
        return $query->where('leave_applications.applier_user_id', Auth::id())
        ->latest('leave_applications.id')
        ->select(
            'leave_applications.id as id', 
            'leave_applications.reason', 
            'leave_applications.information', 
            'leave_applications.start_date',
            'leave_applications.end_date', 
            'leave_applications.status',
            'leave_applications.remarks',
        );
    }
    
    public function scopeAddLeaveType($query)
    {
        return $query->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
        ->addSelect('leave_types.type');
    }
}
