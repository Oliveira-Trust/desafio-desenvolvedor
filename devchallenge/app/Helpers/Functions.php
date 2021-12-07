<?php

namespace App\Helpers;

class Functions
{
    static function defaultNumberFormat($value)
    {
        return number_format($value, 2, '.', '');
    }
}