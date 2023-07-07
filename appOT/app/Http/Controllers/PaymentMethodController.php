<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentMethodRequest;
use App\Http\Application\UseCases\PaymentMethodUseCase;

class PaymentMethodController extends Controller
{
    private PaymentMethodUseCase $paymentMethodUseCase;

    public function __construct(PaymentMethodUseCase $paymentMethodUseCase)
    {
        $this->paymentMethodUseCase = $paymentMethodUseCase;
        //$this->middleware('can:isAdmin');
    }
    public function index()
    {
        if (Auth::user()->is_admin)
            return $this->paymentMethodUseCase->index();
    }

    public function store(PaymentMethodRequest $request)
    {
        return $this->paymentMethodUseCase->store($request);
    }

    // public function edit(PaymentMethod $paymentMethod)
    // {
    //     return view('payment_methods.edit', compact('paymentMethod'));
    // }

    // public function update(Request $request, PaymentMethod $paymentMethod)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'tax' => 'required|numeric',
    //     ]);

    //     $paymentMethod->update($request->all());

    //     return redirect()->route('payment_methods.index')
    //         ->with('success', 'Payment Method updated successfully.');
    // }

    // public function destroy(PaymentMethod $paymentMethod)
    // {
    //     $paymentMethod->delete();

    //     return redirect()->route('payment_methods.index')
    //         ->with('success', 'Payment Method deleted successfully.');
    // }
}
