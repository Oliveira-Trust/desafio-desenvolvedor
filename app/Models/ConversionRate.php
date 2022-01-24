<?php

declare(strict_types=1);

namespace App\Models;

class ConversionRate
{
    private const VALUE = 3000;
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getFees(): float
    {
        if ($this->money->getMoney() > self::VALUE) {
            return $this->money->getMoney() * 0.01;
        }
        return $this->money->getMoney() * 0.02;
    }
}
