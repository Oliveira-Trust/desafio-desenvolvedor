<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService
{
    public static function listPaymentMethods()
    {
        return PaymentMethod::all();
    }
    
    public static function getPaymentMethod(int $paymentMethodId)
    {
        return PaymentMethod::where('id', $paymentMethodId)->first();
    }
}
