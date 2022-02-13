<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\BusinessRuleExceptions;
use Illuminate\Http\Response;

class ValidateInputValueException extends BusinessRuleExceptions
{
    public function getShortMessage(): string
    {
        return 'ValidateInputValueException';
    }

    public function getDescription(): string
    {
        return 'invalid input value';
    }

    public function getHttpStatus(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
