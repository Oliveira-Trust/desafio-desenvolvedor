<?php

namespace Database\Seeders;

use App\Models\ConversionFee;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class ConversionFeesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['comparison_operator' => '<', 'comparator_value' => 3000, 'fee' => 2, 'status' => true],
            ['comparison_operator' => '>', 'comparator_value' => 3000, 'fee' => 1, 'status' => true]
        );

        ConversionFee::query()->insert($data);
    }
}
