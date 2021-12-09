<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PaymentException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Forma de pagamento não suportado.';
}
