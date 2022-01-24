<?php

declare(strict_types=1);

namespace App\Models;

class CreditCard extends Payment
{
    public const NAME = 'credit_card';
    private const TAX = 0.0763;
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
