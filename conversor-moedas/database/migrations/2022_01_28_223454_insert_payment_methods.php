<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Migrations\Migration;

class InsertPaymentMethods extends Migration
{
    private array $paymentMethods = [
        [
            'name' => 'Boleto',
            'tax' => 1.45
        ],
        [
            'name' => 'Cartão de crédito',
            'tax' => 7.63
        ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PaymentMethod::truncate();
    }
}
