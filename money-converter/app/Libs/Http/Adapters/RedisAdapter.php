<?php
namespace App\Libs\Http\Adapters;

use App\Libs\Http\Contracts\CircuitBreakerAdapter;
use LeoCarmo\CircuitBreaker\Adapters\{RedisAdapter as Adapter};

class RedisAdapter implements CircuitBreakerAdapter
{
    private $host;

    private $port;

    private $password;

    private $namespace;

    public function __construct()
    {
        $this->namespace = config('circuitbreaker.adapters.redis.namespace');
        $this->host = config('circuitbreaker.adapters.redis.host');
        $this->port = config('circuitbreaker.adapters.redis.host');
        $this->password = config('circuitbreaker.adapters.redis.password');
    }

    public function connect(): \Redis
    {
        $redis = new \Redis();
        $redis->connect($this->host, $this->port);
        $redis->auth($this->password);

        return $redis;
    }

    public function create(): Adapter
    {
        return new Adapter($this->connect(), $this->namespace);
    }
}
