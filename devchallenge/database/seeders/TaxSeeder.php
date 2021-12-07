<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax')->insert([
            'name' => '1% above',
            'percent' => 1,
            'application' => 'above',
            'value' => 3000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax')->insert([
            'name' => '2% below',
            'percent' => 2,
            'application' => 'below',
            'value' => 3000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
