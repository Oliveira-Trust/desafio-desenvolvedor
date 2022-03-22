<?php

namespace Database\Seeders;

use App\Models\ConvertionFeeRuleModel;
use App\Services\ComparatorService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConvertionFeeRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConvertionFeeRuleModel::insert([[
            'comparator' => ComparatorService::LESS,
            'comparable_value' => 3000,
            'fee' => .02 ,
            'active' => 1,
        ],
        [
            'comparator' => ComparatorService::GREATER,
            'comparable_value' => 3000,
            'fee' => .01 ,
            'active' => 1,
        ]]);
    }
}
