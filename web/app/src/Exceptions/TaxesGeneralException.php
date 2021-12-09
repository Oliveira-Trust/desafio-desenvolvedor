<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class TaxesGeneralException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Erro ao atualizar as taxas de conversão.';
}
