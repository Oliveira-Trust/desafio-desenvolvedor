<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatesData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([
            'id'=>1,
            'min_amount' => 1000.00,
            'max_amount'=> 100000.00,
            'target_amount'=> 3000.00,
            'rate_min'=> 0.01,
            'rate_max'=> 0.02,
            'rate_bankslips'=> 0.0145,
            'rate_credit_card'=>0.0763, 
        ]);
    }
}
