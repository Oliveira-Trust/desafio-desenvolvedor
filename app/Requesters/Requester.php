<?php

namespace App\Requesters;

abstract class Requester
{
    public function __construct(
        protected \GuzzleHttp\Client $client,
        protected string $baseUrl = '' 
    )
    {
        
    }

    public function resolveRequest(string $method = 'GET', string $path = '')  
    {
        $response = $this->client->request($method, $this->baseUrl . $path)->getBody();
        return json_decode($response->getContents());
    }

}