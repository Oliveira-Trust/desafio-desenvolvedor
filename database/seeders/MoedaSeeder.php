<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MoedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moedas')->insert([
            'nome' => 'Real Brasileiro (BRL)',
            'sigla' => 'BRL'
        ]);

        DB::table('moedas')->insert([
            'nome' => 'Dólar dos Estados Unidos (USD)',
            'sigla' => 'USD'
        ]);

        DB::table('moedas')->insert([
            'nome' => 'Euro (EUR)',
            'sigla' => 'EUR'
        ]);
    }
}
