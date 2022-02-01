<?php

namespace Infra\CircuitBreaker;

use Infra\CircuitBreaker\Adapters\RedisAdapter;
use LeoCarmo\CircuitBreaker\CircuitBreaker;

class GuzzleCircuitBreaker
{
    public function create(): CircuitBreaker
    {
        $adapter = new RedisAdapter();
        $product = config('circuitbreaker.services.awesomeapi.product');

        return new CircuitBreaker($adapter->create(), $product);
    }
}
