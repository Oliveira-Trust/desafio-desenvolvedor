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
        $data = [
            ['descricao' => 'Real Brasileiro', 'sigla' => 'BRL'],
            ['descricao' => 'Dólar Americano', 'sigla' => 'USD'],
            ['descricao' => 'Euro', 'sigla' => 'EUR'],
        ];

        DB::table('moedas')->insert($data);
    }
}
