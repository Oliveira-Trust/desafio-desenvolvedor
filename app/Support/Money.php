<?php

namespace App\Support;

use NumberFormatter;

class Money
{
    public function __construct(protected float $value) {}

    /**
     * Add a %  fee to the value
     */
    public function addFees(float $rate): float
    {
         return round($this->value * ($rate / 100), 2);
    }

    /**
     * Format the value to the given currency.
     */
    public function format(string $currency) : string
    {
        return (new NumberFormatter('pt_BR',NumberFormatter::CURRENCY))->formatCurrency($this->value, $currency);
    }

    /**
     * Get the value of the money
     */
    public function value() : float
    {
        return $this->value;
    }

}
