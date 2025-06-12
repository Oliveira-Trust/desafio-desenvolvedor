<?php

namespace Shared\Exceptions;

use Exception;
use Shared\Enums\HttpStatus;

class HttpException extends Exception {
    private HttpStatus $statusCode;

    public function __construct(
        string $message,
        HttpStatus $statusCode = HttpStatus::BadRequest,
    )
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode->value;
    }
}
