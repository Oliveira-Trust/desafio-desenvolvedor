<?php

declare(strict_types=1);

namespace Integration\CurrencyQuotes\src\Helpers;

use Alvo\Domain\Exceptions\ExceptionAbstract;

class MoneyHelper
{

    public static function floatToMoney($str_num): string
    {
        if (!empty($str_num)) {
            return number_format((float)$str_num, 2, ',', '.');
        }

        return $str_num;
    }
}
