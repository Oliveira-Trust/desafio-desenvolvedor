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
        Schema::create('historics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('payment', 50);
            $table->string('fee', 25);
            $table->string('origin_currency', 15);
            $table->string('destination_currency', 15);
            $table->string('currency_value', 25);
            $table->string('destination_currency_value', 25);
            $table->string('purchased_value', 25);
            $table->string('payment_fee', 25);
            $table->string('conversion_fee', 25);
            $table->string('conversion_value', 25);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historics');
    }
};
