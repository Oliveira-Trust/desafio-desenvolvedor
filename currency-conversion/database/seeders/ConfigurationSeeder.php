<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::delete('delete from configurations');
        DB::table('configurations')->insert([
          'payment_conversion_value' => 3000.00,
          'payment_conversion_min' => 1.00,
          'payment_conversion_max' => 2.00,
          'payment_rate_ticket' => 1.45,
          'payment_rate_credit_card' => 7.63,
          'coin_exchange_from' => 'BRL',
        ]);
    }
}