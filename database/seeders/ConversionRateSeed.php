<?php

namespace Database\Seeders;

use App\Models\ConversionRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversionRateSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversionRate = ["rate_greater_than" => 1, "rate_less_than" => 2, 'currency_value' => 3000];

        ConversionRate::truncate();
        ConversionRate::create($conversionRate);
    }
}
