<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->float('bank_slips', 3, 2)->comment('Valor da taxa do pagamento do tipo boleto em porcentagem, ex: 1.45');
            $table->float('credit_card', 3, 2)->comment('Valor da taxa do pagamento do tipo cartão de crédito em porcentagem, ex: 10.34');
            $table->float('purchase_price_above', 3, 2)->comment('Valor da taxa para preços acima do definido em porcentagem, ex: 1');
            $table->float('purchase_price_below', 3, 2)->comment('Valor da taxa para preços abaixo do definido em porcentagem, ex: 2.45');
            $table->float('purchase_price', 10, 2)->comment('Definição do valor base para as taxas de preço acima ou abaixo, ex: 3000 ou 2345.99');
            $table->string('base_currency', 3)->default('BRL')->comment('Moeda base para o câmbio');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
};
