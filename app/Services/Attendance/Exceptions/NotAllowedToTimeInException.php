<?php

namespace App\Services\Attendance\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class NotAllowedToTimeInException extends RuntimeException
{
    public function __construct($message = 'You are not allowed to time-in today.')
    {
        parent::__construct();
        $this->message = $message;
    }
}
