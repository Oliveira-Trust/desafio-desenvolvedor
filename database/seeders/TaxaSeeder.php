<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['percentual' => 0.02, 'valor_min' => 1000, 'valor_max' => 3000],
            ['percentual' => 0.01, 'valor_min' => 3000.01, 'valor_max' => 100000],
        ];

        DB::table('taxas')->insert($data);
    }
}
