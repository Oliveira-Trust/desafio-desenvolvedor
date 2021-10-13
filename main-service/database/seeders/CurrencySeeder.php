<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nameCurrencies = ['Dolar', 'Euro', 'Dolar Canadense'];
        $codeCurrencies = ['usd', 'eur', 'cad'];

        for ($c = 0; $c<3; $c++) {
            Currency::create([
                'name' => $nameCurrencies[$c],
                'code' => $codeCurrencies[$c]
            ]);
        }
    }
}
