<?php

namespace App\Exceptions;

use App\Models\Money;
use Symfony\Component\HttpFoundation\Response;

class DomainExceptions
{
    public static function valueNotAuthorized(): BuildExceptions
    {
        return new BuildExceptions([
            'message'       => 'Valor permitido maior que R$'. Money::MINIMUM_MONEY .' e menor que R$' . Money::MAXIMUM_MONEY,
            'shortMessage'  => 'valueNotAuthorized',
            'httpCode'      => Response::HTTP_UNPROCESSABLE_ENTITY
        ]);
    }
}