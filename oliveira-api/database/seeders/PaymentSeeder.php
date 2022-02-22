<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'name' => 'Boleto',
            'description' => 'Pagamento via boleto',
            'fee' => 1.45
        ]);

        Payment::create([
            'name' => 'Cartão de crédito',
            'description' => 'Pagamento via cartão de crédito',
            'fee' => 7.63
        ]);
    }
}
