<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ValueOutOfRangeException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'O valor requisitado está fora do limite permitido.';
}
