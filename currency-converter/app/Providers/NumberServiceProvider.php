<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NumberServiceProvider extends ServiceProvider
{
    public static function moneyToFloat( $money )
    {
        $money = str_replace('.', '', $money);
        $money = str_replace(',', '.', $money);

        return $money;
    }

    public static function floatToMoney( $money )
    {
        return number_format($money, 2, ',', '.');
    }
}
