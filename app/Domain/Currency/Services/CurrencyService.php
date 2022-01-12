<?php

namespace App\Domain\Currency\Services;

use App\Domain\Currency\Services\Interfaces\CurrencyServiceInterface;
use App\Domain\Currency\Repositories\Interfaces\CurrencyRepositoryInterface;

class CurrencyService implements CurrencyServiceInterface {

    public function __construct(CurrencyRepositoryInterface $currency)
    {
        $this->currencyRepository = $currency;
    }

    public function getCurrencyCode(int $currencyId):string
    {
        return $this->currencyRepository->getCurrencyCode($currencyId);
    }

    public function getAllCurrencyCodes():object
    {
        $currencyCodes = $this->currencyRepository->getAll();

        $currencyCodes = $this->getKeysFromCollection($currencyCodes);

        return $currencyCodes;
    }

    private function getKeysFromCollection($collection):object
    {
        $filteredResult = $collection->mapWithKeys(function ($item, $key) {
          return [$item['id'] => $item['code'] . ' - ' . $item['name']];
        });

        return $filteredResult;
    }

}
