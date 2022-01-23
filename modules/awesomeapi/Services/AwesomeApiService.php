<?php

declare(strict_types=1);

namespace AwesomeApi\Services;

use AwesomeApi\Adapters\AdapterCurrencyCollection;
use AwesomeApi\Connection\HttpConnection;

class AwesomeApiService
{
    private HttpConnection $httpConnection;

    public function __construct(HttpConnection $httpConnection)
    {
        $this->httpConnection = $httpConnection;
    }

    public function currenciesAvailable(): array
    {
        return (new AdapterCurrencyCollection(
            $this->httpConnection->currenciesAvailable()->json()
        ))
            ->getCurrencies();
    }
}
