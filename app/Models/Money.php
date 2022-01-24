<?php

declare(strict_types=1);

namespace App\Models;

class Money
{
    private const MAXIMUM_MONEY = 100000;
    private const MINIMUM_MONEY = 1000;
    private ?float $money;

    public function __construct(?float $money)
    {
        $this->setMoney($money);
    }

    /** @throws \Throwable */
    private function setMoney($money)
    {
        throw_if(
            $money <= self::MINIMUM_MONEY || $money >= self::MAXIMUM_MONEY,
            new \DomainException(
                'Valor permitido maior R$' . self::MINIMUM_MONEY . 'e menor que R$' . self::MAXIMUM_MONEY
            )
        );
        $this->money = $money;
    }

    public function getMoney(): float
    {
        return $this->money;
    }
}
