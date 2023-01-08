<?php

namespace App\Repositories;

use App\Contracts\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;
use Illuminate\Support\Collection;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface {

    public function getAll(): Collection {
        return PaymentMethod::all();
    }

    public function findOrFail($id): ?PaymentMethod {
        return PaymentMethod::findOrFail($id);
    }

    public function update($id, array $data): PaymentMethod {

        $payment_method = $this->findOrFail($id);

        $payment_method->update($data);

        return $payment_method;
    }
}
