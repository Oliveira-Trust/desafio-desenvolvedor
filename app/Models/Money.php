<?php

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\DomainExceptions;

class Money
{
    public const MAXIMUM_MONEY = 100000;
    public const MINIMUM_MONEY = 1000;
    private ?float $money;

    public function __construct(array $attributes)
    {
        $this->setMoney((float) data_get($attributes, 'money'));
    }

    /** @throws \Throwable */
    private function setMoney($money)
    {
        throw_if(
            $money <= self::MINIMUM_MONEY || $money >= self::MAXIMUM_MONEY,
            DomainExceptions::valueNotAuthorized()
        );
        $this->money = $money;
    }

    public function getMoney(): float
    {
        return $this->money;
    }
}
