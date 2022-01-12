<?php

namespace App\Domain\Currency\Repositories;

use App\Domain\Currency\Repositories\Interfaces\CurrencyRepositoryInterface;
use App\Domain\Currency\Models\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface {

    public function __construct(Currency $currency){
        $this->currency = $currency;
    }

    public function getAll():object
    {
        return $this->currency->all();
    }

    public function getCurrencyCode(int $currencyId):string
    {
        return $this->currency->find($currencyId)->code;
    }
}
