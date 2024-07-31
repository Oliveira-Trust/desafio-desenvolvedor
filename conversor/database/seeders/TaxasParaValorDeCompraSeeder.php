<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxasParaValorDeCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taxa_valor_compra')->insert([
            'valor_base' => 3000.00,
            'taxa_menor_valor' => 0.02,
            'taxa_maior_valor' => 0.01,
          ]);
    }
}
