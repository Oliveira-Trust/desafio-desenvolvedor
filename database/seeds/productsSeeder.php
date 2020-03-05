<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => Str::random(10),
            'ean' => Str::random(10),
            'price' => 10.2,
        ]);
        DB::table('products')->insert([
        'name' => Str::random(10),
        'ean' => Str::random(10),
        'price' => 10.2,
        ]);
        DB::table('products')->insert([
        'name' => Str::random(10),
        'ean' => Str::random(10),
        'price' => 10.2,
        ]);
        DB::table('products')->insert([
        'name' => Str::random(10),
        'ean' => Str::random(10),
        'price' => 10.2,
        ]);
    }
}
