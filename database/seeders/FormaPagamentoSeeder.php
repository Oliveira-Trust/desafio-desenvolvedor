<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FormaPagamento::factory()->count(2)

        ->sequence(
            ['_ID' => '1e6fb29f-b7f2-4ab6-a65f-d0802fcd13ff', 'nome' => 'Boleto', 'sigla' => 'BLT', 'taxa' => 1.45],
            ['_ID' => '4cdf1049-b493-48ed-b1ce-3f874010afba', 'nome' => 'Cartão de Crédito', 'sigla' => 'CC', 'taxa' => 7.63],
        )
        ->create();
    }
}
