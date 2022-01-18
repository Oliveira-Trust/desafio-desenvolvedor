<?php
namespace App\Libs\Http\Contracts;

interface CircuitBreaker
{
     public function createAdapter($adapter, string $service): mixed;
}
