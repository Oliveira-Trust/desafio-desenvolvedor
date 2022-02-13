<?php

declare(strict_types=1);

namespace App\Services\Rate;

class ConversionRate
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function calculateConversionRate(): float
    {
        if ($this->value < 3000) {
            return $this->value * (2 / 100);
        }

        return $this->value * (1 / 100);
    }
}
