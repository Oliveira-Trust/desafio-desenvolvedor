<?php

namespace App\Services\AwesomeApiQuotes\Endpoints;

use App\Services\AwesomeApiQuotes\Endpoints\BaseEndpoint;

class Currencies extends BaseEndpoint
{
    private $path = '/json';

    public function names()
    {
        $jsonString = $this->service->api->get($this->path . '/available/uniq');
        return json_decode($jsonString, true);
    }

    public function available(): array
    {
        $jsonString = $this->service->api->get($this->path . '/available');
        return json_decode($jsonString, true);
    }
}
