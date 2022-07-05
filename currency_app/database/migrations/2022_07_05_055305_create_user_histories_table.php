<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();

            $table->string('origin_currency', 3)->comment('moeda de origem');
            $table->string('destination_currency', 3)->comment('moeda de destino');
            $table->float('value')->comment('valor da conversao');
            $table->string('payment_method')->comment('metodo de pagamento');
            $table->float('destination_currency_price')->comment('valor da moeda de destino');
            $table->float('selling_price')->comment('valor de compra');
            $table->float('payment_method_fee')->comment('taxa de metodo de pagamento');
            $table->float('convertion_fee')->comment('taxa de conversao');
            $table->float('discounted_value')->comment('valor descontado');
            $table->foreignId('user_id')->constrained()->restrictOnDelete();

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
        Schema::dropIfExists('user_histories');
    }
};
