<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxasParaFormasDePagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taxa_modalidade_pgto')->insert([
          'tipo_pagamento' => 'Boleto',
          'taxa' => 0.0145
        ]);

        DB::table('taxa_modalidade_pgto')->insert([
            'tipo_pagamento' => 'Cartão de Crédito',
            'taxa' => 0.0763
          ]);
    }
}
