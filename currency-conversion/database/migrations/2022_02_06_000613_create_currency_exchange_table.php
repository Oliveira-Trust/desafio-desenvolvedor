<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyExchangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->float('initial_conversion_value');
            $table->string('coin_exchange_from',10); //moeda inicial BRL
            $table->string('coin_exchange_to', 10); //moeda de conversão ex EUR(euro)
            $table->string('form_of_payment'); // forma de pagamento (cartão ou boleto)
            $table->string('target_currency_value'); //Valor da "Moeda de destino"
            $table->float('target_currency_purchased'); // Valor comprado em "Moeda de destino"
            $table->float('payment_rate'); // Taxa de pagamento
            $table->float('conversion_rate');// taxa de conversão
            $table->float('final_conversion_value');//Valor utilizado para conversão
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_exchanges');
    }
}
