<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('taxas')->insert([
            'enumTipoTaxa' => 'tipo-pagamento',
            'idTipoPagamento' =>  1,
            'flTaxa' => 1.45,
            'flValorMinTaxa' => 0,
            'flValorMaxTaxa' => 0
        ]);

        DB::table('taxas')->insert([
            'enumTipoTaxa' => 'tipo-pagamento',
            'idTipoPagamento' =>  2,
            'flTaxa' => 7.63,
            'flValorMinTaxa' => 0,
            'flValorMaxTaxa' => 0
        ]);
       
        DB::table('taxas')->insert([
            'enumTipoTaxa' => 'conversao',
            'idTipoPagamento' =>  null,
            'flTaxa' => 2.00,
            'flValorMinTaxa' => 0,
            'flValorMaxTaxa' => 2999
        ]);
        DB::table('taxas')->insert([
            'enumTipoTaxa' => 'conversao',
            'idTipoPagamento' =>  null,
            'flTaxa' => 1.00,
            'flValorMinTaxa' => 3000,
            'flValorMaxTaxa' => 100000
        ]);
    }
}
