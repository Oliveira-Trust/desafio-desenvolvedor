<?php
namespace App\Libs\Http\Adapters;

use App\Libs\Http\Contracts\CircuitBreakerAdapter;
use LeoCarmo\CircuitBreaker\Adapters\{RedisAdapter as Adapter};
use Redis;

class RedisAdapter implements CircuitBreakerAdapter
{
    private string $host;

    private string $port;

    private string $namespace;

    public function __construct()
    {
        $this->namespace = config('circuitbreaker.adapters.redis.namespace');
        $this->host = config('circuitbreaker.adapters.redis.host');
        $this->port = config('circuitbreaker.adapters.redis.host');
    }

    public function connect(): Redis
    {
        $redis = new Redis();
        $redis->connect($this->host, (int)$this->port);

        return $redis;
    }

    public function create(): Adapter
    {
        return new Adapter($this->connect(), $this->namespace);
    }
}
