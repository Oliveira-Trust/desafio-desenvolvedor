<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository
{
    public function findBy(array $attributes): Collection
    {
        return Payment::where($attributes)->get();
    }

    public function findAll(): Collection
    {
        return Payment::all();
    }
}
