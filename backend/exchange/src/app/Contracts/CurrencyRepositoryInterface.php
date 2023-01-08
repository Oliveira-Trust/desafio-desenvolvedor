<?php

namespace App\Contracts;

use App\Models\Currency;
use Illuminate\Support\Collection;

interface CurrencyRepositoryInterface {
    public function getAll(): Collection;

    public function findOrFail($id): ?Currency;

    public function findOrFailByCode($code): ?Currency;

}
