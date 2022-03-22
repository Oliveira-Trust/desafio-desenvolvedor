<?php

namespace App\Services;

class MoneyFormatterService
{
    public static function round(float $value): float
    {
        return round($value, 2);
    }
}