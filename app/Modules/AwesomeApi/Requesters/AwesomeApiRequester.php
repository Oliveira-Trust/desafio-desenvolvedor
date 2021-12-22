<?php

namespace AwesomeApi\Requesters;

use App\Requesters\Requester;

class AwesomeApiRequester extends Requester
{
    public function __construct(
        protected \GuzzleHttp\Client $client,
        protected string $baseUrl = 'https://economia.awesomeapi.com.br/'
    ) {
    }

    public function getCurrencies(): mixed
    {
        $response = $this->resolveRequest('GET', 'json/available/uniq');
        return $response;
    }

    public function getCurrencyValue(string $currency): mixed
    {

        return in_array($currency, array_keys((array) $this->getCurrencies())) ?
            $this->resolveRequest(
                'GET',
                'json/last/' . env('DEFAULT_CURRENCY') . '-' . $currency
            ) :
            false;
    }
}
