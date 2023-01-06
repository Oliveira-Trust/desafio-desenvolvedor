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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('user_id');
            $table->string('origin_currency')->comment('Moeda de origem');
            $table->string('destination_currency')->comment('Moeda de destino');
            $table->float('conversion_value', 10, 2)->comment('Valor para conversão');
            $table->string('payment_method')->comment('Método de pagamento');
            $table->float('exchange', 10, 2)->comment('Câmbio atual');
            $table->float('pay_rate_value', 10, 2)->comment('Valor da taxa de pagamento descontado do valor para conversão');
            $table->float('exchange_rate_value', 10, 2)->comment('Valor da taxa de câmbio descontado do valor para conversão');
            $table->float('pay_rate', 3, 2)->comment('Taxa de pagamento atual');
            $table->float('exchange_rate', 3, 2)->comment('Taxa de câmbio descontado atual');
            $table->float('conversion_value_with_fees', 10, 2)->comment('Valor para conversão descontado as taxas');
            $table->float('purchased_value', 10, 2)->comment('Valor comprado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
};
