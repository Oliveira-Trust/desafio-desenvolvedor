<?php

namespace App\Services;

class ConversionTaxService
{
    const THRESHOLD = 3000;

    public static function fromValue(int $value): float
    {
        $threshold = self::THRESHOLD * 100;

        return match (true) {
            $value >= $threshold => 0.01,
            $value < $threshold => 0.02,
        };
    }
}
