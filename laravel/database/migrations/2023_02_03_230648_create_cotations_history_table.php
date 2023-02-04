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
        Schema::create('cotations_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->char('currency_origin', 3);
            $table->char('currency_buy', 3);
            $table->decimal('amount', 11,2);
            $table->decimal('currency_value', 11,2);
            $table->string('payment_type', 20);
            $table->decimal('value_bought', 11,2);
            $table->decimal('payment_tax', 11,2);
            $table->decimal('conversion_tax', 11,2);
            $table->decimal('conversion_value', 11,2);
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
        Schema::dropIfExists('cotations_history');
    }
};
