<?php

declare(strict_types=1);

namespace Integration\currencyQuotes\src\Exceptions;

use App\Exceptions\Config\BaseException;
use App\Exceptions\Config\BuildExceptions;
use Illuminate\Http\Response;

final class ExchangeException
{
    public static function notFoundTypePayment(): void
    {
        $exc = new BaseException(
            'typePaymentNotFound',
            'Tipo de pagamento não encontrado!',
            'O pagamento escolhido não está parametrizado!',
            'Contate o chat para mais informações.',
            Response::HTTP_NOT_FOUND
        );

        throw new BuildExceptions($exc);
    }
}
