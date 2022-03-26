<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Dirham dos Emirados', 'symbol' => 'AED', 'status' => true),
            array('name' => 'Peso Argentino', 'symbol' => 'ARS', 'status' => true),
            array('name' => 'Dólar Australiano', 'symbol' => 'AUD', 'status' => true),
            array('name' => 'Boliviano', 'symbol' => 'BOB', 'status' => true),
            array('name' => 'Bitcoin', 'symbol' => 'BTC', 'status' => true),
            array('name' => 'Dólar Canadense', 'symbol' => 'CAD', 'status' => true),
            array('name' => 'Franco Suíço', 'symbol' => 'CHF', 'status' => true),
            array('name' => 'Peso Chileno', 'symbol' => 'CLP', 'status' => true),
            array('name' => 'Yuan Chinês', 'symbol' => 'CNY', 'status' => true),
            array('name' => 'Peso Colombiano', 'symbol' => 'COP', 'status' => true),
            array('name' => 'Coroa Dinamarquesa', 'symbol' => 'DKK', 'status' => true),
            array('name' => 'EDogecoin', 'symbol' => 'DOG', 'status' => true),
            array('name' => 'Ethereum', 'symbol' => 'ETH', 'status' => true),
            array('name' => 'Euro', 'symbol' => 'EUR', 'status' => true),
            array('name' => 'Libra Esterlina', 'symbol' => 'GBP', 'status' => true),
            array('name' => 'Dólar de Hong Kong', 'symbol' => 'HKD', 'status' => true),
            array('name' => 'Novo Shekel Israelense', 'symbol' => 'ILS', 'status' => true),
            array('name' => 'Rúpia Indiana', 'symbol' => 'INR', 'status' => true),
            array('name' => 'Iene Japonês', 'symbol' => 'JPY', 'status' => true),
            array('name' => 'Litecoin', 'symbol' => 'LTC', 'status' => true),
            array('name' => 'Peso Mexicano', 'symbol' => 'MXN', 'status' => true),
            array('name' => 'Coroa Norueguesa', 'symbol' => 'NOK', 'status' => true),
            array('name' => 'Dólar Neozelandês', 'symbol' => 'NZD', 'status' => true),
            array('name' => 'Sol do Peru', 'symbol' => 'PEN', 'status' => true),
            array('name' => 'Zlóti Polonês', 'symbol' => 'PLN', 'status' => true),
            array('name' => 'Guarani Paraguaio', 'symbol' => 'PYG', 'status' => true),
            array('name' => 'Rublo Russo', 'symbol' => 'RUB', 'status' => true),
            array('name' => 'Riyal Saudita', 'symbol' => 'SAR', 'status' => true),
            array('name' => 'Coroa Sueca', 'symbol' => 'SEK', 'status' => true),
            array('name' => 'Dólar de Cingapura', 'symbol' => 'SGD', 'status' => true),
            array('name' => 'Baht Tailandês', 'symbol' => 'THB', 'status' => true),
            array('name' => 'Nova Lira Turca', 'symbol' => 'TRY', 'status' => true),
            array('name' => 'Dólar Taiuanês', 'symbol' => 'TWD', 'status' => true),
            array('name' => 'Dólar Americano', 'symbol' => 'USD', 'status' => true),
            array('name' => 'Peso Uruguaio', 'symbol' => 'UYU', 'status' => true),
            array('name' => 'XRP', 'symbol' => 'XRP', 'status' => true),
            array('name' => 'Rand Sul-Africano', 'symbol' => 'ZAR', 'status' => true),
        );

        foreach ($data as $value) {
             Currency::query()->updateOrInsert(
                ['symbol' => $value['symbol']],
                $value
            );
        }
    }
}
