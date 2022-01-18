<?php
namespace App\Libs\Http\Contracts;

use LeoCarmo\CircuitBreaker\CircuitBreaker as ICircuitBreaker;

interface CircuitBreaker
{
    public function create(): ICircuitBreaker;
}
