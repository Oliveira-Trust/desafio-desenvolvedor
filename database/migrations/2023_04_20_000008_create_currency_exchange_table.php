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
        Schema::create('currency_exchange', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('from_currency');
            $table->string('to_currency');
            $table->double('currency_value');
            
            $table->unsignedBigInteger('payment_method_id');
            $table->double('payment_method_rate');
            $table->double('payment_method_tax');
            $table->double('amount');
            $table->double('amount_tax');
            $table->double('amount_after_taxes');
            $table->double('net_total');

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
        Schema::dropIfExists('currency_exchange');
    }
}
