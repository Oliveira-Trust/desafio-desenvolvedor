<?php

namespace Database\Seeders;

use App\Models\ExchangeFeeConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeFeeConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExchangeFeeConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'lower_than_threshold' => 2.00,
                'greater_than_threshold' => 1.00,
                'amount_threshold' => 3000.00,
            ]
        );
    }
}
