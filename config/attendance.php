<?php

// config for Ianvizarra/Attendance
return [
    'logs_table' => 'attendance_logs',
    'schedule' => [
        'timeIn' => 9,
        'timeOut' => 17,
        'requiredDailyHours' => 8,
        'timeInAllowance' => 30, // minutes
        'workDays' => [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
        ],
        'offDays' => [
            'Saturday',
        ],
    ],
    'user_model' => config('auth.providers.users.model', \App\Models\User::class),
    'users_table' => 'users',
];
