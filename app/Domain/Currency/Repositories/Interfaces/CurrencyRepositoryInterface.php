<?php

namespace App\Domain\Currency\Repositories\Interfaces;
use App\Domain\Currency\Models\Currency;

interface CurrencyRepositoryInterface {

    public function getAll():object;

    public function getCurrencyCode(int $currencyId):string;

}
