<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'payroll_batch';
    protected $fillable = [
        'name',
        'status'
    ];

    public function employee() {
        return $this->hasMany(Payroll::class, 'batch_id');
    }

    public function users() {
        return $this->hasManyThrough(User::class, Payroll::class, 'batch_id', 'id', 'id','user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->toDayDateTimeString();
    }
}
