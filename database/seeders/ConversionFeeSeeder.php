<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversionFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ConversionFee::create([
            'fee' => 2.0,
            'fee_relative_amount' => 3000,
            'conversion_fee_math_operator_id' => 1,
        ]);

        \App\Models\ConversionFee::create([
            'fee' => 1.0,
            'fee_relative_amount' => 3000,
            'conversion_fee_math_operator_id' => 4,
        ]);
    }
}
