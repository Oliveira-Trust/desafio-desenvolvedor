<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('clients')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
            ]);
        }
    }
}
