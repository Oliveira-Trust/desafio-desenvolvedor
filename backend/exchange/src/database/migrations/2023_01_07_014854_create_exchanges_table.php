<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('exchanges', function(Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->foreignId('origin_currency_id')
                  ->comment('Moeda de origem')
                  ->constrained('currencies');

            $table->foreignId('destination_currency_id')
                  ->comment('Moeda de destino')
                  ->constrained('currencies');

            $table->foreignId('payment_method_id')
                  ->comment('Forma de pagamento')
                  ->constrained('payment_methods');

            $table->double('origin_value', 20, 2)
                  ->comment('Valor para conversão');

            $table->double('origin_value_without_fees', 20, 2)
                  ->comment('Valor utilizado para conversão descontando as taxas');

            $table->double('purchased_value', 20, 2)
                  ->comment('Valor comprado em "Moeda de destino" com taxas');

            $table->double('destination_exchange_rate', 20, 4)
                  ->comment('Valor da "Moeda de destino" usado para conversão');

            $table->double('payment_method_fee_value', 20, 2)
                  ->comment('Taxa de pagamento');

            $table->double('exchange_fee_value', 20, 2)
                  ->comment('Taxa de conversão');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('exchanges');
    }
};
