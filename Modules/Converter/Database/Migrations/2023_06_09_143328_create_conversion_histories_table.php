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
        Schema::create('conversion_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('destination_currency');
            $table->decimal('value_to_convert', 19, 2);
            $table->string('payment_method');
            $table->decimal('destination_currency_value', 19, 2);
            $table->decimal('purchase_value', 19, 2);
            $table->decimal('payment_fee', 19, 2);
            $table->decimal('conversion_fee', 19, 2);
            $table->decimal('final_conversion_value', 19, 2);
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
        Schema::dropIfExists('conversion_histories');
    }
};
