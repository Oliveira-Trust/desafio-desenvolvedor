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
            $table->string('payment');
            $table->decimal('fee', 4);
            $table->string('origin_currency');
            $table->string('destination_currency');
            $table->decimal('currency_value');
            $table->decimal('destination_currency_value');
            $table->decimal('purchased_value');
            $table->decimal('payment_fee');
            $table->decimal('conversion_fee');
            $table->decimal('conversion_value');
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
