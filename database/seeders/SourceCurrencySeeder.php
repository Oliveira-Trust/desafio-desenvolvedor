<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SourceCurrency::create([
            'id' => 1,
            'symbol' => 'R$',
            'acronym' => 'BRL',
            'description' => 'Real Brasileiro'
        ]);
    }
}
