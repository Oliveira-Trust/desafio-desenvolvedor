<?php

namespace Module\Broker\Gateway;

class FakeEURCurrencyConvertGateway implements CurrencyConvertGateway
{
    public function convert(string $to, string $from = 'BRL'): int
    {
        $value = 6.07;

        return number_format($value, 2, '.', '') * 100;
    }
}
