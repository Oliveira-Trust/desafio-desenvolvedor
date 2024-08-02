<?php

namespace Module\Broker\Gateway;

class FakeUSDCurrencyConvertGateway implements CurrencyConvertGateway
{
    public function convert(string $to, string $from = 'BRL'): int
    {
        return 530;
    }
}
