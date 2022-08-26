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
            'description' => 'menor que',
        ]);

        \App\Models\ConversionFeeMathOperator::create([
            'id' => 2,
            'symbol' => '<=',
            'description' => 'menor ou igual a',
        ]);

        \App\Models\ConversionFeeMathOperator::create([
            'id' => 3,
            'symbol' => '>',
            'description' => 'maior que',
        ]);
        
        \App\Models\ConversionFeeMathOperator::create([
            'id' => 4,
            'symbol' => '>=',
            'description' => 'maior ou igual a',
        ]);
    }
}
