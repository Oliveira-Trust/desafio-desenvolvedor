<?php

namespace Domain\PaymentMethod\Repositories;

use Domain\PaymentMethod\Models\PaymentMethod;
use Domain\PaymentMethod\Repositories\Interfaces\PaymentMethodRepositoryInterface;

final class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function findById(int $paymentMethodId): PaymentMethod
    {
        return PaymentMethod::find($paymentMethodId);
    }

    public function findByName(string $name): PaymentMethod
    {
        return PaymentMethod::where('name', $name)->first();
    }

    public function findAll()
    {
        return PaymentMethod::all();
    }
}
