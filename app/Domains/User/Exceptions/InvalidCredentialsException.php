<?php

namespace App\Domains\User\Exceptions;

use App\Shared\Errors\DomainException;
use App\Shared\Errors\ErrorCode;

final class InvalidCredentialsException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            errorCode: ErrorCode::AUTH_INVALID_CREDENTIALS,
            httpStatus: 401,
            contextErrors: null,
            message: 'Invalid credentials.'
        );
    }
}
