<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feeRules = [
            [
                'rule' => "<",
                'value' => 3000,
                'fee' => 0.02
            ],
            [
                'rule' => ">=",
                'value' => 3000,
                'fee' => 0.01
            ]
        ];

        DB::table('fee_rules')->insert($feeRules);
    }
}
