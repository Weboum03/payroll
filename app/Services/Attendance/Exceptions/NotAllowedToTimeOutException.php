<?php

namespace App\Services\Attendance\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class NotAllowedToTimeOutException extends RuntimeException
{
    public function __construct($message = 'You are not allowed to time-out yet.')
    {
        parent::__construct();
        $this->message = $message;
    }
}
