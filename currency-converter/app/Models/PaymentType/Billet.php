<?php

namespace App\Models\PaymentType;

use App\Models\PaymentType\PaymentType;

class Billet extends PaymentType implements PaymentTypeContract
{
    public function getTax(): float
    {
        return .0145;
    }

    public function getReadableName(): string
    {
        return 'Boleto';
    }

    public function getSlug(): string
    {
        return 'billet';
    }
}