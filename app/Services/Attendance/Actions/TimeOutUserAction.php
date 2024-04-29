<?php

namespace App\Services\Attendance\Actions;

use App\Services\Attendance\Contracts\CanLogAttendance;
use App\Services\Attendance\DataTransferObjects\AttendanceLogDto;
use App\Services\Attendance\Enums\AttendanceStatusEnum;
use App\Services\Attendance\Enums\AttendanceTypeEnum;
use App\Services\Attendance\Exceptions\AlreadyTimeInException;
use App\Services\Attendance\Exceptions\AlreadyTimeOutException;
use App\Services\Attendance\Exceptions\NoTimeInException;
use App\Services\Attendance\Facades\Attendance;
use Illuminate\Support\Carbon;

class TimeOutUserAction
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
        if (! $user->hasTimeIn($time)) {
            throw new NoTimeInException();
        }

        if ($user->hasTimeOut($time)) {
            throw new AlreadyTimeOutException();
        }

        $status = Attendance::timeOutStatus($time, $scheduleConfig);

        ($this->logUserAttendanceAction)(new AttendanceLogDto(
            user: $user,
            type: new AttendanceTypeEnum('out'),
            status: new AttendanceStatusEnum($status),
            time: $time ?? new Carbon()
        ));
    }
}
