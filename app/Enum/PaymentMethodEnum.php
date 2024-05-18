<?php

namespace App\Enum;

use App\Enum\Traits\Values;

enum PaymentMethodEnum: string
{
    use Values;

    case BANK_BILLET = 'BANK_BILLET';
    case CREDIT_CARD = 'CREDIT_CARD';

    public function tax(): float
    {
        return match ($this) {
            PaymentMethodEnum::BANK_BILLET => 0.0145,
            PaymentMethodEnum::CREDIT_CARD => 0.0763,
        };
    }
}
