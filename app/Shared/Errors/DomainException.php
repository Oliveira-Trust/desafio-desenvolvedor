<?php

namespace App\Shared\Errors;

use RuntimeException;

abstract class DomainException extends RuntimeException
{
    public function __construct(
        public readonly string $errorCode,
        public readonly int $httpStatus = 400,
        public readonly ?array $contextErrors = null,
        string $message = 'Domain error'
    ) {
        parent::__construct($message);
    }
}