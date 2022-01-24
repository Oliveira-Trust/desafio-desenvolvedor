<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('origin_currency', 3);
            $table->string('destination_currency', 3);
            $table->unsignedDecimal('amount'); // original amount
            $table->unsignedDecimal('amount_received'); // amount received
            $table->unsignedDecimal('amount_converted'); // amount used to convert
            $table->string('payment_method');
            $table->unsignedDecimal('payment_method_fee')->nullable();
            $table->unsignedDecimal('conversion_fee');
            $table->unsignedDecimal('bid')->nullable();
            $table->unsignedDecimal('ask')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
