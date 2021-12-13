<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyExchangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_exchange_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('origin_currency');
            $table->string('origin_currency');
            $table->float('origin_currency_value');
            $table->float('origin_currency_net_value');
            $table->string('destination_currency');
            $table->float('destination_currency_base_value');
            $table->float('converted_value');
            $table->string('payment_method');
            $table->float('payment_tax');
            $table->float('conversion_tax');
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
        Schema::dropIfExists('currency_exchange_logs');
    }
}
