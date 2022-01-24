<?php

declare(strict_types=1);

namespace App\Models;

class BankInvoice extends Payment
{
    public const NAME = 'bank_invoice';
    private const TAX = 0.0145;
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getValueFees(): float
    {
        return ($this->money->getMoney() * self::TAX);
    }
}
