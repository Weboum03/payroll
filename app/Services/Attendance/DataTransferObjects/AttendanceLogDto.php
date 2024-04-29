<?php

namespace App\Services\Attendance\DataTransferObjects;

use App\Services\Attendance\Contracts\CanLogAttendance;
use App\Services\Attendance\Enums\AttendanceStatusEnum;
use App\Services\Attendance\Enums\AttendanceTypeEnum;
use Illuminate\Support\Carbon;

final class AttendanceLogDto
{
    public function __construct(
        public CanLogAttendance $user,
        public AttendanceTypeEnum $type,
        public AttendanceStatusEnum $status,
        public ?Carbon $time = null,
    ) {
    }
}
