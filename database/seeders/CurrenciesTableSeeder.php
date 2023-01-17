<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("currencies")->insert([
            "name" => "Real",
            "code" => "BRL",
        ]);
        DB::table("currencies")->insert([
            "name" => "Dólar Americano",
            "code" => "USD",
        ]);
        DB::table("currencies")->insert([
            "name" => "Euro",
            "code" => "EUR",
        ]);
    }
}
