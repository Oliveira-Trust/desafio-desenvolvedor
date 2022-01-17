<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settions')->insert([
            'boleto' => 1.45, 
            'credito' => 7.63, 
            'conversaomenor' => 2, 
            'conversaomaior' => 1
        ]);
    }
}
