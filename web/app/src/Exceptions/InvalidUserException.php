<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidUserException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Código de usuário inválido.';
}
