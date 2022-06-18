<?php

namespace Oliveiratrust\CurrencyPrice;

use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;

class CurrencyPriceRepository {

    public function __construct(
        private CurrencyPrice $model
    ){}

    public function getCurrentPrice($currency_id): CurrencyPrice
    {
        return $this->model->select('id', 'price')
                           ->where('currency_id', $currency_id)
                           ->orderBy('id', 'DESC')
                           ->firstOrFail();
    }
}
