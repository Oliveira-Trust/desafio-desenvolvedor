<?php

namespace Domain\PaymentMethod\Repositories\Interfaces;

use Domain\PaymentMethod\Models\PaymentMethod;

interface PaymentMethodRepositoryInterface
{
    public function findByName(string $name): PaymentMethod;

    public function findById(int $paymentMethodId): PaymentMethod;

    public function findAll();
}
