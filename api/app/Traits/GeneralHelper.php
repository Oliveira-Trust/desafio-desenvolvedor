<?php

namespace App\Traits;
use Exception;

trait GeneralHelper
{
    public function underscoreToCamelCase(String $string): String
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        $str[0] = strtolower($str[0]);

        return $str;
    }

}
