<?php

namespace AwesomeApi\Services;

use AwesomeApi\Requesters\AwesomeApiRequester;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    public function __construct(
        protected AwesomeApiRequester $awesomeApiRequester
    ) {
    }

    public function getCurrencies()
    {
        return Cache::rememberForever(
            'currencies',
            fn () => $this->awesomeApiRequester->getCurrencies()
        );
    }

    public function currencyValue(string $currency) : mixed
    {
        return Cache::remember(
            $currency,
            env('CURRENCY_TTL'),
            fn () => $this->awesomeApiRequester->getCurrencyValue($currency)
        );
    }
}
