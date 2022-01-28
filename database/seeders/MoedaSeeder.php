<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'strSiglaMoeda' => 'BRL',
            'strDescricaoMoeda' => 'Real',
            'blOrigem' => true,
            'blDestino' => false
        ]);

        DB::table('moedas')->insert([
            'strSiglaMoeda' => 'USD',
            'strDescricaoMoeda' => 'Dólar Americano',
            'blOrigem' => false,
            'blDestino' => true
        ]);

        DB::table('moedas')->insert([
            'strSiglaMoeda' => 'EUR',
            'strDescricaoMoeda' => 'Euro',
            'blOrigem' => false,
            'blDestino' => true
        ]);

        DB::table('moedas')->insert([
            'strSiglaMoeda' => 'DOGE',
            'strDescricaoMoeda' => 'Dogecoin',
            'blOrigem' => false,
            'blDestino' => true
        ]);
    }
}
