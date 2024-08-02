<?php

namespace App\Actions\PaymentMethod;

use App\Actions\Action;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Cache;

class GetPaymentTitle extends Action
{
    public function handle(string $payment): string
    {
        return Cache::rememberForever(
            "paymentMethodTitle::$payment",
            fn () => PaymentMethod::whereLabel($payment)->firstOrFail()->name
        );
    }
}
