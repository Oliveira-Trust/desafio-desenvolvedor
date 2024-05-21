<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodUpdateRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentMethodController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function updatePaymentMethod(PaymentMethodUpdateRequest $request): RedirectResponse
    {
        foreach ($request->only(['payment_slip', 'credit_card']) as $type => $value) {
            $paymentMethod = PaymentMethod::where('type', '=', $type)->first();
            $paymentMethod->value = $value;
            $paymentMethod->save();
        }
        return Redirect::route('settings.edit')->with('status', 'payment-method-updated');
    }
}
