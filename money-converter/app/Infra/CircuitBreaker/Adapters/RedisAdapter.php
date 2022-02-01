<?php

namespace Infra\CircuitBreaker\Adapters;

use Redis;
use LeoCarmo\CircuitBreaker\Adapters\RedisAdapter as Adapter;
use Infra\CircuitBreaker\Adapters\Contracts\CircuitBreakerAdapter;

final class RedisAdapter implements CircuitBreakerAdapter
{
    public function create(): Adapter
    {
        $config = config('circuitbreaker.redis');
        $namespace = config('circuitbreaker.services.awesomeapi.namespace');

        $redis = new Redis();
        $redis->connect($config['host'], $config['port'], 1, NULL, 0, 0, [
            'auth' => [$config['password']]
        ]);

        return new Adapter($redis, $namespace);
    }
}
