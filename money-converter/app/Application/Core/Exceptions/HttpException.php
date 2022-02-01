<?php

namespace App\Core\Exceptions;

use Exception;
use Throwable;

class HttpException extends Exception
{
    private int $statusCode;

    public function __construct($message = "", $statusCode = 400, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
