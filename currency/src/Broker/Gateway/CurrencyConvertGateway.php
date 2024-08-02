<?php

declare(strict_types=1);

namespace Module\Broker\Gateway;

interface CurrencyConvertGateway
{
    public function convert(string $to, string $from = 'BRL'): int;
}
