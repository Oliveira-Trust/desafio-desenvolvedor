<?php

namespace Infra\AwesomeApi;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use LeoCarmo\CircuitBreaker\{GuzzleMiddleware, CircuitBreaker};
use Infra\CircuitBreaker\GuzzleCircuitBreaker;

class AwesomeApiClient extends Client
{
    public function __construct()
    {
        parent::__construct([
            'base_uri' => config('awesomeapi.url'),
            'handler' => $this->createHandlers(),
            'timeout'  => 2.0,
        ]);
    }

    private function createHandlers(): HandlerStack
    {
        $guzzleCircuitBreaker = new GuzzleCircuitBreaker();

        $handler = new GuzzleMiddleware($guzzleCircuitBreaker->create());

        $handlers = HandlerStack::create();
        if (config('app.env') === 'test') $handlers->push($handler);

        return $handlers;
    }
}
