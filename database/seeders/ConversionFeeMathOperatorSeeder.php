<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversionFeeMathOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ConversionFeeMathOperator::create([
            'id' => 1,
            'symbol' => '<',
            'description' => 'para valores menores que',
        ]);

        \App\Models\ConversionFeeMathOperator::create([
            'id' => 2,
            'symbol' => '<=',
            'description' => 'para valores menores ou iguais a',
        ]);

        \App\Models\ConversionFeeMathOperator::create([
            'id' => 3,
            'symbol' => '>',
            'description' => 'para valores maiores que',
        ]);
        
        \App\Models\ConversionFeeMathOperator::create([
            'id' => 4,
            'symbol' => '>=',
            'description' => 'para valores maiores ou iguais a',
        ]);
    }
}
