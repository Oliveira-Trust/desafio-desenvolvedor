<?php

namespace App\Http\Helpers;

class Helper
{

    public static function formatValue( $value)
    {
        return str_replace(',', '', $value);
    }
}
