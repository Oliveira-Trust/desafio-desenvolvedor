<?php

namespace App\Traits;

trait GeneralHelper
{
    public function underscoreToCamelCase($string): String
    {

    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    $str[0] = strtolower($str[0]);

    return $str;
}
}
