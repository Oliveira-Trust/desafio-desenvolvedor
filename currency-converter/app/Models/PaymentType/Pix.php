<?php

namespace App\Models\PaymentType;

use App\Models\PaymentType\PaymentType;

class Pix extends PaymentType implements PaymentTypeContract
{
    public function getTax(): float
    {
        return 10;
    }

    public function getReadableName(): string
    {
        return 'Pix';
    }

    public function getSlug(): string
    {
        return 'px';
    }
}