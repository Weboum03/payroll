<?php

namespace App\Services\Attendance\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class NoTimeInException extends RuntimeException
{
    public function __construct($message = 'You did not time-in today.')
    {
        parent::__construct();
        $this->message = $message;
    }
}
