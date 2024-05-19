<?php

namespace Database\Seeders;

use Database\Factories\CurrencyFactory;
use Database\Factories\PaymentMethodFactory;
use Database\Factories\TaxFactory;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $boleto = PaymentMethodFactory::new()->create(['name' => 'Boleto']);
        $creditCard = PaymentMethodFactory::new()->create(['name' => 'Cartão de Crédito']);

        TaxFactory::new()->createMany([
            [
                'name' => 'Taxa sobre o valor',
                'amount' => 3000,
                'type' => 'amount_fee',
                'min_amount_rate' => 2,
                'max_amount_rate' => 1,
            ],
            [
                'name' => 'Taxa de pagamento com cartão de Crédito',
                'rate' => 7.63,
                'type' => 'payment_fee',
                'payment_method_id' => $creditCard->id
            ],
            [
                'name' => 'Taxa de pagamento com boleto',
                'rate' => 1.45,
                'type' => 'payment_fee',
                'payment_method_id' => $boleto->id
            ],
        ]);

        CurrencyFactory::new()->createMany([
            ['name' => 'Dolar Americano', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'Libra Esterlina', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Yuan Chinês', 'code' => 'CNY', 'symbol' => '¥'],
            ['name' => 'Rúpia Indiana', 'code' => 'INR', 'symbol' => '₹'],
            ['name' => 'Novo Shekel Israelense', 'code' => 'ILS', 'symbol' => '₪'],
        ]);
    }
}
