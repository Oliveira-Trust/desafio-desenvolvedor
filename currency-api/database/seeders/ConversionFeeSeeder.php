<?php

namespace Database\Seeders;

use App\Models\ConversionFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversionFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConversionFee::updateOrCreate(
            ['id' => 1],
            [
                'lower_than_threshold' => 2.00,
                'greater_than_threshold' => 1.00,
                'amount_threshold' => 3000.00,
            ]
        );
    }
}
