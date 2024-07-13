<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(self::tuples() as $tuple) {
            $payment = Payment::select('slug')->where($tuple)->get();

            if($payment->isEmpty()) {
                Payment::factory()->create($tuple);
            }
        }
    }

    private static function tuples(): array
    {
        return[
            [
                'slug' => 'bank-slip',
                'name' => 'Boleto',
                'rate' => '1.45',
            ],
            [
                'slug' => 'credit-card',
                'name' => 'Credit Card',
                'rate' => '7.63',
            ]
        ];
    }
}
