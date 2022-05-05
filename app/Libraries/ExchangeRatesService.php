<?php
namespace App\Libraries;

use App\Models\Currency;
use Ldmuniz\AwesomeAPIMoedas\AwesomeAPIMoedas;

class ExchangeRatesService{
    public function getRate($currency_iso): float{
        $default_currency = Currency::where('default',true)->first()->isocode;        
        $api = new AwesomeAPIMoedas();
        $data = $api->get($currency_iso.'-'.$default_currency);
        return floatVal($data['bid']);
    }
}

?>