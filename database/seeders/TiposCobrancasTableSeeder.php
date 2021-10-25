<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TiposCobrancasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createTiposCobrancas();
    }

    public function createTiposCobrancas(){
        DB::table('tipos_cobrancas')
            ->insert([
                'nom_tipo_cobranca' => 'Boleto',
                'ind_status' => 1,
            ]);

        DB::table('tipos_cobrancas')            
            ->insert([
                'nom_tipo_cobranca' => 'Cartão de Crédito',
                'ind_status' => 1,
            ]);
    }
}
