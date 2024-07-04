<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fees')->insert([
            'name' => '2% low threshold',
            'rate' => 2,
            'threshold' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('fees')->insert([
            'name' => '1% high threshold',
            'rate' => 1,
            'threshold' => 3000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
