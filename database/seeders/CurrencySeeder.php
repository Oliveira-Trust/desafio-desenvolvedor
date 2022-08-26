<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Currency::create([
            'id' => 1,
            'symbol' => 'R$',
            'acronym' => 'BRL',
            'description' => 'Real Brasileiro'
        ]);

        \App\Models\Currency::create([
            'id' => 2,
            'symbol' => '$',
            'acronym' => 'USD',
            'description' => 'Dólar Americano'
        ]);

        \App\Models\Currency::create([
            'id' => 3,
            'symbol' => '€',
            'acronym' => 'EUR',
            'description' => 'Euro'
        ]);
    }
}
