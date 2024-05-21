<?php

namespace App\Services\AwesomeApiQuotes\Endpoints;

use App\Services\AwesomeApiQuotes\Endpoints\BaseEndpoint;
use App\Services\AwesomeApiQuotes\Entities\QuoteEntity;

class Quotes extends BaseEndpoint
{
    private $path = '/json';

    public function currency(string $currency)
    {
        $jsonString = $this->service->api->get($this->path . "/{$currency}");
        return json_decode($jsonString, true);
    }

    public function last(): array
    {
        $jsonString = $this->service->api->get($this->path . '/last/USD-BRL,EUR-BRL,BTC-BRL');
        $data = array_values(json_decode($jsonString, true));
        return $this->transform($data, QuoteEntity::class)->toArray();
    }
}
