<?php

namespace Database\Seeders;

use App\Models\Historic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HistoricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        Historic::create([
            'user_id' => $user->id,
            'payment' => 'Boleto',
            'fee' => 1.45,
            'origin_currency' => 'BRL',
            'destination_currency' => 'USD',
            'currency_value' => 5000.00,
            'destination_currency_value' => 5.30,
            'purchased_value' => 920.18,
            'payment_fee' => 72.50,
            'conversion_fee' => 50.00,
            'conversion_value' => 4877.50,
        ]);
    }
}
