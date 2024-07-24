<?php

namespace App\Services\Attendance\Models;

use App\Services\Attendance\Database\Factories\AttendanceLogFactory;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class AttendanceLog extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $fillable = ['status', 'type', 'user_id', 'minutes_rendered', 'date', 'time'];

    protected $dates = ['created_at'];

    /**
     * Creates a new instance of the model.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('attendance.log_table');
    }

    protected static function newFactory()
    {
        return AttendanceLogFactory::new();
    }

    public static function getMondaysBetween($startDate, $endDate, $day = 'Mon')
    {
        // Parse the start and end dates
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Generate the period between the dates
        $period = CarbonPeriod::create($start, $end);

        // Filter to get only Mondays
        $dates = [];
        foreach ($period as $date) {
            if ($day == 'Mon' && $date->isMonday()) {
                $dates[] = $date->format('Y-m-d');
            }
            if ($day == 'Tues' && $date->isTuesday()) {
                $dates[] = $date->format('Y-m-d');
            }
            if ($day == 'Wed' && $date->isWednesday()) {
                $dates[] = $date->format('Y-m-d');
            }
            if ($day == 'Thu' && $date->isThursday()) {
                $dates[] = $date->format('Y-m-d');
            }
            if ($day == 'Fri' && $date->isFriday()) {
                $dates[] = $date->format('Y-m-d');
            }
            if ($day == 'Sat' && $date->isSaturday()) {
                $dates[] = $date->format('Y-m-d');
            }
            if ($day == 'Sun' && $date->isSunday()) {
                $dates[] = $date->format('Y-m-d');
            }

        }

        return $dates;
    }
}
