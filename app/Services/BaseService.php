<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ApiQuoteException;
use GuzzleHttp\Client as GuzzleHttpClient;

abstract class BaseService
{
    public function guzzleHttpClient(array $handler = []): GuzzleHttpClient
    {
        return new GuzzleHttpClient($handler);
    }

    /** @throws ApiQuoteException */
    public function baseUrl(string $param = null): string
    {
        if ($param === null || empty(env('API_QUOTE'))) {
            throw new ApiQuoteException();
        }

        return env('API_QUOTE') . $param;
    }
}
