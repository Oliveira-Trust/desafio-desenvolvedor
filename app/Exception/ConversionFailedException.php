<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ConversionFailedException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            message: __('messages.currency-conversion.failed'),
            statusCode: Response::HTTP_INTERNAL_SERVER_ERROR,
        );
    }
}
