<?php
namespace App\Libs\Http\Contracts;

use LeoCarmo\CircuitBreaker\Adapters\{RedisAdapter};

interface CircuitBreakerAdapter
{
    public function connect(): \Redis;
    public function create(): RedisAdapter;
}
