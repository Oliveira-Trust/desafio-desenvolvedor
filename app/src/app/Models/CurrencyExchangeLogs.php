<?php

namespace App\Models;

use App\Modules\CurrencyExchange\Module as CurrencyExchange;
use Jenssegers\Mongodb\Eloquent\Model;

class CurrencyExchangeLogs extends Model
{
    protected $connection = 'mongodb';

    public function getPaymentMethodAttribute($value)
    {
        switch (strtoupper($value)) {
            case        'BANKSLIP': $translatedPaymentMethod = 'Boleto Bancário';         break;
            case        'CREDITCARD': $translatedPaymentMethod = 'Cartão de Crédito';     break;
            default:    $translatedPaymentMethod = 'Não identificado';                    break;
        }

        return $translatedPaymentMethod;
    }
}
