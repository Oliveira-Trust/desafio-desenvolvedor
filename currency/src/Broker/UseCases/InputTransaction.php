<?php

declare(strict_types=1);

namespace Module\Broker\UseCases;

final readonly class InputTransaction
{
    public function __construct(
        public string $currencyDestination,
        public int $amount,
        public string $paymentMethod
    ) {}
}
