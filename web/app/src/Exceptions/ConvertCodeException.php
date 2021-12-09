<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ConvertCodeException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Código de conversão não suportado.';
}
