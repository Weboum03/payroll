<?php

namespace App\Services\Attendance\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class AlreadyTimeOutException extends RuntimeException
{
    public function __construct($message = 'You have already time-out today.')
    {
        parent::__construct();
        $this->message = $message;
    }
}
