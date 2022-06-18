<?php

namespace Oliveiratrust\Currency;

use Illuminate\Database\Eloquent\Collection;
use Oliveiratrust\Models\Currency\Currency;

class CurrencyRepository {

    public function __construct(
        private Currency $model
    ){}

    public function getActivesCurrencies(int $currency_id = null): Collection
    {
        return $this->model->when($currency_id, fn($q) => $q->where('currency_id', $currency_id))
                           ->where('active', true)
                           ->get();
    }
}
