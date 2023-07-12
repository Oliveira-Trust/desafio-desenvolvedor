<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ConversionFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now();

        DB::table('conversion_fees')->insert([
            'reference_value' => 3000.00,
            'fee_lower_value' => 2.00,
            'fee_higher_value' => 1.00,
            'created_at' => $now,
            'updated_at' => $now,

        ]);
    }
}
