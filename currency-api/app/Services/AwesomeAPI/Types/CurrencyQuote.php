<?php

namespace App\Services\AwesomeAPI\Types;

readonly class CurrencyQuote
{
    public function __construct(
        public string $baseCurrencyCode,
        public string $targetCurrencyCode,
        public string $name,
        public float $buyRate,
        public float $sellRate
    ) { }
}
