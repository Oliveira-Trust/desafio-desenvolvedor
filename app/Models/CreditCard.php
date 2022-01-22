<?php

declare(strict_types=1);

namespace App\Models;

class CreditCard extends Payment
{
    private const TAX = 7.63;
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getValueFees(): float
    {
        return $this->money->getMoney() * self::TAX;
    }
}
