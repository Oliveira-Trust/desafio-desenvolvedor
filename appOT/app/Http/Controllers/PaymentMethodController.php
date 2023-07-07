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
    }
    public function index()
    {
        //if (Auth::user()->is_admin)
            return $this->paymentMethodUseCase->index();
    }

    public function store(PaymentMethodRequest $request)
    {
        if (Auth::user()->is_admin)
        return $this->paymentMethodUseCase->store($request);
    }

}
