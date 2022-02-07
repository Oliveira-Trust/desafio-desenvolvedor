<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinConvertionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_convertions', function (Blueprint $table) {
/*
Moeda de origem: BRL - OK
Moeda de destino: USD - OK
Valor para conversão: R$ 5.000,00 - OK
Forma de pagamento: Boleto - OK
Valor da "Moeda de destino" usado para conversão: $ 5,30 - OK
Valor comprado em "Moeda de destino": $ 920,18 (taxas aplicadas no valor de compra diminuindo no valor total de conversão) - OK
Taxa de pagamento: R$ 72,50 - OK
Taxa de conversão: R$ 50,00 - OK
Valor utilizado para conversão descontando as taxas: R$ 4.877,50 - OK
*/
            $table->id();

            $table->char('currency_origin', 3);

            $table->char('currency_destin', 3);

            $table->float('conversion_value');

            $table->string('payment_method', 100);

            //quote obtained from currency
            $table->float('current_quote_destin')->nullable();

            // considering discounts
            $table->float('purchased_total')->nullable();

            $table->float('payment_fee')->nullable();

            $table->float('convertion_fee')->nullable();

            $table->float('used_value_currency_conversion')->nullable();

            $table->unsignedBigInteger('config_id');

            // history
            $table->unsignedBigInteger('user_id');

            /**
             * Danger on delete because cascade!!! But this provides integrity
             */
            $table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->enum('status', ['SUCCESS', 'ERROR', 'WAITING'])->default('WAITING');

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
        Schema::dropIfExists('coin_convertions');
    }
}
