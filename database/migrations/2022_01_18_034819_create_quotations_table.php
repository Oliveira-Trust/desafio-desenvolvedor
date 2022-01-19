<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('target_coin');
            $table->string('source_coin');
            $table->decimal('conversion_amount',12,2);
            $table->string('payment_type');
            $table->decimal('source_coin_value',12,2);
            $table->decimal('buy_amount',12,2);
            $table->decimal('rate_payment',12,2);
            $table->decimal('conversion_rate',12,2);
            $table->decimal('net_amount',12,2);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('quotations');
    }
}
