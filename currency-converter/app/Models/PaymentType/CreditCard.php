<?php

namespace App\Models\PaymentType;

use App\Models\PaymentType\PaymentType;

class CreditCard extends PaymentType implements PaymentTypeContract
{
    public function getTax(): float
    {
        return 7.63;
    }

    public function getReadableName(): string
    {
        return 'Cartão de Crédito';
    }

    public function getSlug(): string
    {
        return 'credit-card';
    }
}