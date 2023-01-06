<?php

namespace App\Enums;

enum PaymentTypsEnum: string
{
    case TICKET = 'Boleto';
    case CREDIT = 'Cartão de Crédito';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
