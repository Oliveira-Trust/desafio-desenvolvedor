<?php

namespace App\Http\Infrastructure\Repositories;

use App\Models\PaymentMethod;
use App\Domain\Repositories\PaymentMethodRepositoryInterface;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{

    public function index()
    {
        return  PaymentMethod::all();
    }


    public function store($request): PaymentMethod
    {
        return PaymentMethod::create($request->all());
    }

    public function show(int $id)
    {
        $paymentMethod = PaymentMethod::where('id', $id)->get();
        if ($paymentMethod->isEmpty()) {
            return ['message' => 'Método de Pagamento não encontrado.'];
        }
        return $paymentMethod->toArray();
    }
    public function getTax(int $id): float
    {
        $paymentMethod = PaymentMethod::select('tax')->where('id', $id)->first();
        if (!isset($paymentMethod->tax)) {
            return -1;
        }
        return $paymentMethod->tax;
    }
}
