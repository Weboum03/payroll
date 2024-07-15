<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deboard extends Model
{
    use HasFactory;

    protected $table = 'deboards';

    protected $appends = ['duration'];

    protected $fillable = [
        'user_id',
        'reason',
        'notice_period',
        'comment',
        'start_date',
        'final_employment_date',
        'final_working_date',
        'report_to',
        'support_comment',
        're_employable',
        'remaining_pl_year',
        'remaining_pl_leave',
    ];

    protected $casts = [
        're_employable' => 'boolean'
    ];
    

    public function getDurationAttribute()
    {
        return (new Carbon($this->start_date))->diffInDays(new Carbon($this->final_working_date));
    }
}
