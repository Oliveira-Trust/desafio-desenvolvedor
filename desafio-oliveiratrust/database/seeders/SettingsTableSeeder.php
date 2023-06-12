<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'ticket_tax' => 1.45,
            'credit_card_tax' => 7.63,
            'conversion_tax_start' => 1,
            'conversion_tax_end' => 2,
        ]);
    }
}
