<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormasPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formas_pagamentos')->insert([
            'nome' => 'BOLETO',
            'taxa' => 1.45
        ]);

        DB::table('formas_pagamentos')->insert([
            'nome' => 'CARTÃO DE CREDITO',
            'taxa' => 7.63
        ]);
    }
}
