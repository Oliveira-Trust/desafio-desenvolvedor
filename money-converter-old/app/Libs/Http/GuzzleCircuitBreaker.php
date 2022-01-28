<?php
namespace App\Libs\Http;

use App\Libs\Http\Contracts\{CircuitBreaker as ICircuitBreaker};
use App\Libs\Http\Contracts\CircuitBreakerAdapter;
use LeoCarmo\CircuitBreaker\Adapters\RedisAdapter;
use LeoCarmo\CircuitBreaker\CircuitBreaker;

class GuzzleCircuitBreaker implements ICircuitBreaker
{
    private RedisAdapter $adapter;

    private string $service;

    public function __construct(CircuitBreakerAdapter $adapter)
    {
        $this->adapter = $adapter->create();
        $this->service = config('circuitbreaker.service');
    }

    public function create(): CircuitBreaker
    {
        return new CircuitBreaker($this->adapter, $this->service);
    }
}
