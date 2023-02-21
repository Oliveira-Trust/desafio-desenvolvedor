<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoMoedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TipoMoeda::factory()->count(4)
        ->sequence(
            ['nome' => 'Real Brasileiro', 'sigla' => 'BRL'],
            ['nome' => 'Dólar Americano', 'sigla' => 'USD'],
            ['nome' => 'Dólar Canadense', 'sigla' => 'CAD'],
            ['nome' => 'Euro', 'sigla' => 'EUR'],
        )
        ->create();
    }
}
