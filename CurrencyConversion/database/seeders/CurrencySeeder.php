<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Date = \Carbon\Carbon::now();

        $Data  =  [
            ['abbreviation' => 'USD', 'name' => 'Dólar Americano', 'created_at' => $Date, 'updated_at' => $Date], 
            ['abbreviation' => 'EUR', 'name' => 'Euro', 'created_at' => $Date, 'updated_at' => $Date],
            ['abbreviation' => 'JPY', 'name' => 'Iene Japonês', 'created_at' => $Date, 'updated_at' => $Date]
        ];
        Currency::insert($Data);

    }
}