<?php

namespace Converter\Observers;

use Converter\Models\Payment;

class PaymentObserver
{
    public function created(Payment $payment)
    {
        $payment->user_id = auth()->user()->id;
        $payment->save();
    }
}