<?php

namespace App\Helpers;

use DateTime;

class DateHelper
{
    public static function formatDateTime($value, $format = 'd/m/Y - H:i'): string
    {
        $dateTime = new DateTime($value);
        return $dateTime->format($format);
    }
}


if (! function_exists('format_date_time')) {
    function format_date_time($value, $format = 'd/m/Y - H:i'): string
    {
        return \App\Helpers\DateHelper::formatDateTime($value, $format);
    }
}
