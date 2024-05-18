<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CoinNotExistException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            message: __('messages.currency-conversion.coin-not-supported'),
            statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }
}
