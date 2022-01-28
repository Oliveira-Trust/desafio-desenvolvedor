<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_pagamentos')->insert([
            'strTipoPagamento' => 'Boleto'
        ]);

        DB::table('tipo_pagamentos')->insert([
            'strTipoPagamento' => 'Cartão de Crédito'
        ]);
        
        
    }
}
