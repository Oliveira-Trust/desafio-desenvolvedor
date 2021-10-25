<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DominiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createDominios();
    }

    public function createDominios(){
        DB::table('dominios')
            ->insert([
                'id' => 'ind_status',
                'dsc_dominio' => 'Status'
            ]); 

        $indStatus = DB::table('dominios')->where('id', 'ind_status')->first();

        DB::table('dominios_itens')
            ->insert([
                'dominio_id' => $indStatus->id,
                'dsc_dominio_item' => 'Ativo',
                'val_dominio_item' => 1
            ]);

        DB::table('dominios_itens')
            ->insert([
                'dominio_id' => $indStatus->id,
                'dsc_dominio_item' => 'Inativo',
                'val_dominio_item' => 2
            ]);
    }  
}
