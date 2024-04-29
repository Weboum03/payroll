<?php

namespace App\Services\Attendance\Traits;

use App\Services\Attendance\Actions\LogUserAttendanceAction;
use App\Services\Attendance\DataTransferObjects\AttendanceLogDto;
use App\Services\Attendance\Enums\AttendanceStatusEnum;
use App\Services\Attendance\Enums\AttendanceTypeEnum;
use App\Services\Attendance\Facades\Attendance;
use App\Services\Attendance\Models\AttendanceLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

trait HasAttendance
{
    public function attendance(): HasMany
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function hasTimeIn(Carbon $time = null): bool
    {
        return $this->attendance()
            ->where('date', $time ? $time->toDateString() : now()->toDateString())
            ->where('type', AttendanceTypeEnum::in())
            ->exists();
    }

    public function hasTimeOut(Carbon $time = null): bool
    {
        return $this->attendance()
            ->where('date', $time ? $time->toDateString() : now()->toDateString())
            ->where('type', AttendanceTypeEnum::out())
            ->exists();
    }

    public function hasWorked(Carbon $time = null): bool
    {
        return $this->hasTimeIn($time) && $this->hasTimeOut($time);
    }

    public function getTimeIn(Carbon $time = null): ?Model
    {
        return $this->attendance()
            ->where('date', $time ? $time->toDateString() : now()->toDateString())
            ->where('type', AttendanceTypeEnum::in())
            ->first();
    }

    public function logAttendance($type, $status = 'on-time', Carbon $time = null): void
    {
        app(LogUserAttendanceAction::class)(new AttendanceLogDto(
            user: $this,
            type: new AttendanceTypeEnum($type),
            status: new AttendanceStatusEnum($status),
            time: $time ?? new Carbon()
        ));
    }

    public function isOffDay(Carbon $time = null, $scheduleConfig = null): bool
    {
        return Attendance::isOffDay($time, $scheduleConfig);
    }

    public function isWorkDay(Carbon $time = null, $scheduleConfig = null): bool
    {
        return Attendance::isWorkDay($time, $scheduleConfig);
    }
}
