<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CurrencyDestinySeeder extends Seeder
{
    private $table = 'currency_destiny';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->insert([
            'name' => 'USD',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table($this->table)->insert([
            'name' => 'EUR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
