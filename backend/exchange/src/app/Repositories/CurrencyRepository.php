<?php

namespace App\Repositories;

use App\Contracts\CurrencyRepositoryInterface;
use App\Models\Currency;
use Illuminate\Support\Collection;

class CurrencyRepository implements CurrencyRepositoryInterface {

    public function getAll(): Collection {
        return Currency::all();
    }

    public function findOrFail($id): ?Currency {
        return Currency::findOrFail($id);
    }

    public function findOrFailByCode($code): ?Currency {
        return Currency::where('code', $code)->firstOrFail();
    }
}
