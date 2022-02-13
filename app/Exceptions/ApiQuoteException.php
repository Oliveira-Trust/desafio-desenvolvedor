<?php

namespace App\Exceptions;

use App\Exceptions\BusinessRuleExceptions;
use Illuminate\Http\Response;

class ApiQuoteException extends BusinessRuleExceptions
{
    public function getShortMessage(): string
    {
        return 'ApiQuoteException';
    }

    public function getDescription(): string
    {
        return 'error api';
    }

    public function getHttpStatus(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
