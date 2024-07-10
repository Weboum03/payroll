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
        'actual_payble_days',
        'working_days',
        'loss_pay_days',
        'payble_days',
        'commission',
        'payout',
        'reimbursement',
        'leave_bal',
        'shift_differential',
        'retroactive_pay'
    ];
}
