<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConfiguracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracoes')->insert([
            'taxa_boleto' => 1.45,
            'taxa_cartao' => 7.63,
            'taxa_conversao_abaixo_3mil' => 2,
            'taxa_conversao_acima_3mil' => 1
        ]);
    }
}
