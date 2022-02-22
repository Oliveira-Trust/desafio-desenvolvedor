<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'BRL',
            'description' => 'Real brasileiro'
        ]);

        Currency::create([
            'name' => 'USD',
            'description' => 'Dólar americano'
        ]);

        Currency::create([
            'name' => 'BTC',
            'description' => 'Bitcoin'
        ]);
    }
}
