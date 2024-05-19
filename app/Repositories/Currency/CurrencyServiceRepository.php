<?php

namespace App\Repositories\Currency;

use App\Interface\Currency\CurrencyServiceInterface;
use App\Services\Currency\CurrencyService;
Class CurrencyServiceRepository implements CurrencyServiceInterface
{
    private $currencyService;
    public function __construct(CurrencyService $currencyService) {
        $this->currencyService = $currencyService;
    }
    public function getLatestOccurrences(string $currencies): array
    {
        //TODO: implementar essa funcao
        return [123];
    }

    public function getAvailableCurrencies(): array
    {
        //TODO: implementar essa funcao
        return [];
    }

    public function getCurrencyNames(): array
    {
        //TODO: implementar essa funcao
        return [];
    }

}