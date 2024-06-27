<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payrolls';

    protected $fillable = [
        'batch_id',
        'user_id',
        'gross_wages',
        'deduction',
        'salary',
        'overtime',
        'bonus',
        'commission',
        'payout',
        'reimbursement',
        'leave_bal',
    ];
}
