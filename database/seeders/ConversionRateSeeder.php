<?php

namespace Database\Seeders;

use App\Models\ConversionRate;
use Illuminate\Database\Seeder;

class ConversionRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rates = [
            [
                'value' => 3000.00,
                'down' => 2.00,
                'up' => 1.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        ConversionRate::insert($rates);
    }
}
