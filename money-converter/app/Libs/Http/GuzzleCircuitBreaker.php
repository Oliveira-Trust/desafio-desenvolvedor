<?php
namespace App\Libs\Http;

use App\Libs\Http\Contracts\CircuitBreaker;

class GuzzleCircuitBreaker implements CircuitBreaker
{
    public function createAdapter($adapter, string $service): mixed
    {

    }
}
