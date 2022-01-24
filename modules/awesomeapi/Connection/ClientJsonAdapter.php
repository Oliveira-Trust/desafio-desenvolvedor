<?php

declare(strict_types=1);

namespace AwesomeApi\Connection;

use AwesomeApi\Adapters\CurrencyAdapter;
use AwesomeApi\Models\Currency;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ClientJsonAdapter extends BaseHttpConnection implements HttpConnection
{
    public function currenciesAvailable(): Response
    {
        return Http::get($this->getBaseUrl() . AwesomeRoutes::AVAILABLE_CURRENCIES);
    }

    public function quoteCurrency(array $attributes): Currency
    {
        $currency = data_get($attributes, 'destination_currency');
        $response = Http::get($this->getBaseUrl() . AwesomeRoutes::QUOTE_CURRENCY . "/$currency");
        return new Currency(new CurrencyAdapter($response->json()));
    }
}
