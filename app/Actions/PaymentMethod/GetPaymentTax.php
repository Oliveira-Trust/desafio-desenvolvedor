<?php

namespace App\Actions\PaymentMethod;

use App\Actions\Action;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Cache;

class GetPaymentTax extends Action
{
    public function handle(float $amount, string $payment): float
    {
        $paymentMethod = Cache::rememberForever("paymentMethod::$payment", fn () => PaymentMethod::whereLabel($payment)->firstOrFail());

        return ($amount * $paymentMethod->tax) / 100;
    }
}
