<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deboard extends Model
{
    use HasFactory;

    protected $table = 'deboards';
    protected $fillable = [
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
}
