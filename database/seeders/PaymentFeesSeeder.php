<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('payment_fees')->insert([
            ['type' => 1, 'fee' => 1.45, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 2, 'fee' => 7.63, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
