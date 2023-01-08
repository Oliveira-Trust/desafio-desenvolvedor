<?php

namespace App\Contracts;

use App\Models\PaymentMethod;
use Illuminate\Support\Collection;

interface PaymentMethodRepositoryInterface {
    public function getAll(): Collection;

    public function findOrFail($id): ?PaymentMethod;

    public function update($id, array $data): PaymentMethod;

}
