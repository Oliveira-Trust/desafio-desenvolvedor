<?php

namespace CurrencyConverter\Domain\Currency\DTOs;

/**
 * Class Convert
 * @package CurrencyConverter\Domain\Currency\DTOs
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class ListData
{
    public static string $originCurrency;
    public static string $destinyCurrency;
    public static string $valueConversion;
    public static string $paymentMethod;
    public static string $destinationCurrencyValueForConversion;
    public static string $paymentRate;
    public static string $conversionRate;
    public static string $valuePurchasesInDestinationCurrency;

    public static function toArray()
    {
        return [
            'origin_currency' => self::$originCurrency,
            'destiny_currency' => self::$destinyCurrency,
            'value_conversion' => self::$valueConversion,
            'payment_method' => self::$paymentMethod,
            'destination_currency_value_for_conversion' => self::$destinationCurrencyValueForConversion,
            'payment_rate' => self::$paymentRate,
            'conversion_rate' => self::$conversionRate,
            'value_purchases_in_destination_currency' => self::$valuePurchasesInDestinationCurrency,
        ];
    }
}
