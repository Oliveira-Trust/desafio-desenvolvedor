<?php

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Cache;

if (! function_exists('paymentMethods')) {
    function paymentMethods(): array
    {
        return Cache::rememberForever('paymentMethods', fn () => PaymentMethod::active()->pluck('name', 'label')->toArray());
    }
}
