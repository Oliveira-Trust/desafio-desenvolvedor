<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class OrdersGeneralException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Erro ao listar as orders de compra.';
}
