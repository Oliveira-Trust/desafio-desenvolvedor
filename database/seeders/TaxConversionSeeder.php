<?php

namespace Database\Seeders;

use App\Models\TaxConversion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxConversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaxConversion::create([
            'reference_value' => 3000.00,
            'down_value_tax' => 2,
            'up_value_tax' => 1,
        ]);
    }
}
