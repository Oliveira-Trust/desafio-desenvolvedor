<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (! function_exists('formatDateAndTime')) {
    function formatDateAndTime(Carbon $date, $format = 'd/m/Y H:i')
    {
        return $date->format($format);
    }
}

if (! function_exists('convertBRLCurrencyToFloat')) {
    function convertBRLCurrencyToFloat(?string $value): float
    {
        if (empty($value)) {
            return 0;
        }

        $integers = Str::before($value, ',');
        $decimals = Str::after($value, ',');

        $integers = str_replace('R$', '', $integers);
        $integers = str_replace('.', '', $integers);

        // Converte o valor para float
        return floatval($integers) + (intval($decimals) / 100);
    }
}

if (! function_exists('formatPercentValue')) {
    function formatPercentValue(float $percent)
    {
        return number_format($percent * 100, 2, ',', '.').'%';
    }
}

if (! function_exists('convertPercentValueToDecimal')) {
    function convertPercentValueToDecimal(?string $percent): float
    {
        if (empty($percent)) {
            return 0;
        }

        $percentValue = Str::of($percent)->replaceEnd('%', '')->replace(',', '.');

        return ((float) $percentValue->value()) / 100;
    }
}

if (! function_exists('formatCurrencyValue')) {
    function formatCurrencyValue(?float $value): string
    {
        if (empty($value)) {
            return '';
        }

        return 'R$ '. number_format($value, 2, ',', '.');
    }
}

if (! function_exists('formatMoney')) {
    function formatMoney(?float $value, ?string $currencyCode): string
    {
        if (empty($value) || empty($currencyCode)) {
            return '';
        }

        $formatter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($value, $currencyCode);
    }
}

if (! function_exists('getSourceCurrency')) {
    function getSourceCurrency(?object $currencyQuotation): string
    {
        if (! $currencyQuotation) {
            return '';
        }

        return $currencyQuotation?->code.' - '.Str::before($currencyQuotation?->name, '/');
    }
}

if (! function_exists('getDestinationCurrency')) {
    function getDestinationCurrency(?object $currencyQuotation): string
    {
        if (empty($currencyQuotation)) {
            return '';
        }

        return $currencyQuotation?->codein.' - '.Str::after($currencyQuotation?->name, '/');
    }
}
