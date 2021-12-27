<?php

namespace CurrencyConverter\Domain\Currency\DTOs;

/**
 * Class Convert
 * @package CurrencyConverter\Domain\Currency\DTOs
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class FormData
{
    public static string $destinyCurrency;
    public static string $valueConversion;
    public static string $paymentMethod;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance::$paymentMethod = $data['payment_method'];
        $instance::$valueConversion = $data['value_for_conversion'];
        $instance::$destinyCurrency = $data['destiny_currency'];

        return $instance;
    }

    public static function toArray(): array
    {
        return [
            'payment_method' => self::$paymentMethod,
            'value_for_conversion' => self::$valueConversion,
            'destiny_currency' => self::$destinyCurrency
        ];
    }
}
