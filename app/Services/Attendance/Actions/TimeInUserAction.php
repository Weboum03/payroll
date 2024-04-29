<?php

namespace App\Services\Attendance\Actions;

use App\Services\Attendance\Contracts\CanLogAttendance;
use App\Services\Attendance\DataTransferObjects\AttendanceLogDto;
use App\Services\Attendance\Enums\AttendanceStatusEnum;
use App\Services\Attendance\Enums\AttendanceTypeEnum;
use App\Services\Attendance\Exceptions\AlreadyTimeInException;
use App\Services\Attendance\Exceptions\NotAllowedToTimeInException;
use App\Services\Attendance\Facades\Attendance;
use Illuminate\Support\Carbon;

class TimeInUserAction
{
    public function __construct(public LogUserAttendanceAction $logUserAttendanceAction)
    {
    }

    /**
     * @param  CanLogAttendance  $user
     * @param  ?Carbon  $time
     *
     * @throws AlreadyTimeInException
     */
    public function __invoke(CanLogAttendance $user, Carbon $time = null, array $scheduleConfig = null): void
    {
        if ($user->hasTimeIn($time)) {
            throw new AlreadyTimeInException();
        }

        if ($user->hasTimeIn($time)) {
            throw new AlreadyTimeInException();
        }

        if ($user->isOffDay($time)) {
            throw new NotAllowedToTimeInException("It's your day-off");
        }

        if (! $user->isWorkDay($time)) {
            throw new NotAllowedToTimeInException();
        }

        $status = Attendance::timeInStatus($time, $scheduleConfig);

        ($this->logUserAttendanceAction)(new AttendanceLogDto(
            user: $user,
            type: new AttendanceTypeEnum('in'),
            status: new AttendanceStatusEnum($status),
            time: $time ?? new Carbon()
        ));
    }
}
