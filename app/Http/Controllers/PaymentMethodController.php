<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();

        return view('payment-methods.index', [ 'payment_methods' => $payment_methods ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  PaymentMethod $payment_method
     */
    public function show(PaymentMethod $payment_method)
    {
        return view('payment-methods.edit', [ 'payment_method' => $payment_method ]);
    }

    /**
     * Update resources in storage.
     *
     * @param  \Illuminate\Http\UpdatePaymentMethodRequest  $request
     * @param  PaymentMethod $payment_method
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $payment_method)
    {
        $payment_method->update($request->all());
        alert()->success('Sucesso','Taxa atualizada');

        return redirect()->route('payment-methods');
    }
}
