<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['descricao' => 'Boleto', 'percentual' => 0.0145],
            ['descricao' => 'Cartão de Crédito', 'percentual' => 0.0763],
        ];

        DB::table('formas')->insert($data);
    }
}
