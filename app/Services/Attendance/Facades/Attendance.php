<?php

namespace App\Services\Attendance\Facades;

use Illuminate\Support\Facades\Facade;

class Attendance extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \App\Services\Attendance\Attendance::class;
    }
}
