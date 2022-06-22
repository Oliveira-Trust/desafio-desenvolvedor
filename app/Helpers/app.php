<?php

use Carbon\Carbon;

if (! function_exists('currencyFormat')) {
    function currencyFormat($value, $preffix = '')
    {
        return $preffix . ' ' . number_format((float)$value, 2, ',', '.');
    }
}

if (! function_exists('percentageFormat')) {
    function percentageFormat($value, $decimals = 3)
    {
        return number_format((float)$value, $decimals, ',', '.');
    }
}

if (! function_exists('quantityFormat')) {
    function quantityFormat($value, $decimals = 3)
    {
        return number_format((float)$value, $decimals, ',', '.');
    }
}
