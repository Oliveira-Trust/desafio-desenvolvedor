<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CurrencyConverterGeneralException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Para realizar a conversão envie os parâmetros: code, value e payment.';
}
