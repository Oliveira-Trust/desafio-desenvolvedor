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
        Schema::create('quotation_histories', function (Blueprint $table) {
            $table->id();
            $table->string('currency_origin');
            $table->string('target_currency');
            $table->decimal('value_origin');
            $table->decimal('value_origin_with_discount');
            $table->decimal('rate_payment');
            $table->decimal('rate_convert');
            $table->decimal('value_target_currency');
            $table->decimal('value_base_convert');
            $table->string('payment_method');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_histories');
    }
};
