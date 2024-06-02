<?php
namespace App\Helpers;

class CurrencyHelper
{
    const CONVERSION_FACTOR = 100000;

    /**
     * Convert the amount to cents.
     * 
     * @param float $amount The amount.
     * @return int The amount in cents.
     */
    public static function toCents(float $amount): int
    {
        return (int) ($amount * self::CONVERSION_FACTOR);
    }
    
    /**
     * Convert the amount in cents to currency.
     * 
     * @param int $amountInCents The amount in cents.
     * @return float The amount in currency.
     */
    public static function toCurrency(int $amountInCents): float
    {
        return round($amountInCents / self::CONVERSION_FACTOR, 3);
    }
}
