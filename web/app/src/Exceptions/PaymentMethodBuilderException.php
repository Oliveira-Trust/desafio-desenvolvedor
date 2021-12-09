<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodBuilderException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Erro ao gerar a cobraça para a forma de pagamento desejada.';
}
