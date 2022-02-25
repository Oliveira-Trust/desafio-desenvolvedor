<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case BANK_SLIP = 'bankSlip';
    case CREDIT_CARD = 'creditCard';

    public static function getView(string $paymentMethod): string
    {
        return match ($paymentMethod) {
            PaymentMethod::BANK_SLIP->value => 'Bank slip',
            PaymentMethod::CREDIT_CARD->value => 'Credit card'
        };
    }
}
