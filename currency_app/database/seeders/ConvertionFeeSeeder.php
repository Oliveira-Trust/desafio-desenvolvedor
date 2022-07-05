<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConvertionFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ConvertionFee::factory()->create([
            'base_value' => 3000,
            'lt_fee'     => 2,
            'gt_fee'     => 1,
            'active'     => true
        ]);
    }
}
