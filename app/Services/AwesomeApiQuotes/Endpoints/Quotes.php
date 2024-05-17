<?php

namespace App\Services\AwesomeApiQuotes\Endpoints;

use App\Services\AwesomeApiQuotes\Endpoints\BaseEndpoint;
use App\Services\AwesomeApiQuotes\Entities\Quote as QuoteEntity;
use Illuminate\Support\Collection;

class Quotes extends BaseEndpoint
{
    private $path = '/json';

    public function last($currencies)
    {
        $jsonString = $this->service->api->get($this->path . "/last/{$currencies}");
        return json_decode($jsonString, true);
    }

    public function available(): array
    {
        $jsonString = $this->service->api->get($this->path . '/available');
        return json_decode($jsonString, true);
    }
}
