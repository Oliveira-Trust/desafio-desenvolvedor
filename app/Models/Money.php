<?php

declare(strict_types=1);

namespace App\Models;

class Money
{
    private const MAXIMUM_MONEY = 100000;
    private const MINIMUM_MONEY = 1000;
    private float $money;

    public function __construct(float $money)
    {
        $this->money = $this->setMoney($money);
    }

    /** @throws \Throwable */
    private function setMoney(): float
    {
        throw_if(
            $this->money <= self::MINIMUM_MONEY || $this->money >= self::MAXIMUM_MONEY,
            new \DomainException(
                'Valor permitido maior R$' . self::MINIMUM_MONEY . 'e menor que R$' . self::MAXIMUM_MONEY
            )
        );

        return $this->money;
    }

    public function getMoney(): float
    {
        return $this->money;
    }
}
