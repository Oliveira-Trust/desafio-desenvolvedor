<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TargetCurrency::create([
            'id' => 1,
            'symbol' => '$',
            'acronym' => 'USD',
            'description' => 'Dólar Americano'
        ]);

        \App\Models\TargetCurrency::create([
            'id' => 2,
            'symbol' => '€',
            'acronym' => 'EUR',
            'description' => 'Euro'
        ]);
    }
}