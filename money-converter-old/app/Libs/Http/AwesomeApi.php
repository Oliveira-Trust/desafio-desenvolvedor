<?php
namespace App\Libs\Http;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use LeoCarmo\CircuitBreaker\{GuzzleMiddleware, CircuitBreaker};

class AwesomeApi extends Client
{
    private CircuitBreaker $circuit;

    public function __construct(GuzzleCircuitBreaker $circuit)
    {
        $this->circuit = $circuit->create();

        parent::__construct([
            'base_uri' => config('awesomeapi.url'),
            'handler' => $this->createHandlers(),
            'timeout'  => 2.0,
        ]);
    }

    private function createHandlers(): HandlerStack
    {
        $handler = new GuzzleMiddleware($this->circuit);

        $handlers = HandlerStack::create();
        $handlers->push($handler);

        return $handlers;
    }
}
