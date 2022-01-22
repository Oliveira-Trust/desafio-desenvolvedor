<?php

declare(strict_types=1);

namespace AwesomeApi\Services;

use AwesomeApi\Connection\HttpConnection;
use Illuminate\Http\Client\Response;

class AwesomeApiService
{
    private HttpConnection $httpConnection;

    public function __construct(HttpConnection $httpConnection)
    {
        $this->httpConnection = $httpConnection;
    }

    public function currenciesAvailable(): Response
    {
        return $this->httpConnection->currenciesAvailable();
    }
}
