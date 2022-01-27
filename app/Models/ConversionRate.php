<?php

declare(strict_types=1);

namespace App\Models;

class ConversionRate
{
    public const VALUE = 3000;
    public const TAX_LARGER_THREE_THOUSAND = 0.01;
    public const TAX_SMALLER_THREE_THOUSAND = 0.02;
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getFees(): float
    {
        if ($this->money->getMoney() > self::VALUE) {
            return $this->money->getMoney() * self::TAX_LARGER_THREE_THOUSAND;
        }
        return $this->money->getMoney() * self::TAX_SMALLER_THREE_THOUSAND;
    }
}
