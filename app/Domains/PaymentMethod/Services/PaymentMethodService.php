<?php

namespace App\Domains\PaymentMethod\Services;

use App\Domains\PaymentMethod\Models\PaymentMethod;

class PaymentMethodService
{
    public function getFee($paymentMethodID)
    {
        return PaymentMethod::find($paymentMethodID)->fee;
    }
}
