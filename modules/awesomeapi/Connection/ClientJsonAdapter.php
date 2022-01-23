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
        $response = Http::get($this->getBaseUrl() . AwesomeRoutes::AVAILABLE_CURRENCIES);
        throw_if($response->failed(), new \DomainException('Não foi possível listar as moedas'));
        return $response;
    }

    public function quoteCurrency(string $currency): Currency
    {
        $response = Http::get($this->getBaseUrl() . AwesomeRoutes::QUOTE_CURRENCY . "/$currency");
        throw_if($response->failed(), new \DomainException('Nao disponível no momento'));
        return new Currency(new CurrencyAdapter($response->json()));
    }
}
