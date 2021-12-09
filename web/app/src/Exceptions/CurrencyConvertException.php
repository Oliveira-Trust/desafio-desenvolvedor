<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CurrencyConvertException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Erro ao realizar a conversão para a moeda desejada.';
}
