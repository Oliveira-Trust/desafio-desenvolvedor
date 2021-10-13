<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;

class PaymentMethodController extends Controller
{
    private $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    public function index()
    {
        $paymentMethods = $this->paymentMethodService->getAllPaymentMethods();

        return view('paymentMethod.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('paymentMethod.create');
    }

    public function store(PaymentMethodRequest $request)
    {
        $paymentMethod = $this->paymentMethodService->storePaymentMethod((array)$request->validated());

        return redirect()->route('payment-methods.index')->with('message', 'Meio de Pagamento cadastrado com sucesso!');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('paymentMethod.edit', compact('paymentMethod'));
    }

    public function update(PaymentMethodRequest $request, $paymentMethod)
    {
        $result = $this->paymentMethodService->updatePaymentMethod($paymentMethod, (array)$request->validated());

        return redirect()->route('payment-methods.index')->with('message', 'Meio de Pagamento alterado com sucesso!');
    }
}
