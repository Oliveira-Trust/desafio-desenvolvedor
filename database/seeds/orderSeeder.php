<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class orderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10),
        ]);
        DB::table('clients')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10),
        ]);
        DB::table('clients')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10),
        ]);
        DB::table('clients')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10),
        ]);
    }
}
