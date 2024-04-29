<?php

namespace App\Services\Attendance\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class AlreadyTimeInException extends RuntimeException
{
    public function __construct($message = 'You have already time-in today.')
    {
        parent::__construct();
        $this->message = $message;
    }
}
