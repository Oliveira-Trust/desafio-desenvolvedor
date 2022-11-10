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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('value', 8, 2);
            $table->string('method', 20);
            $table->string('currency_from', 3);
            $table->string('currency_to', 3);
            $table->string('exchange_name', 100);
            $table->dateTime('exchange_date_time');
            $table->decimal('bid', 8, 4);
            $table->decimal('payment_method_rate_discount', 8, 2);
            $table->decimal('conversion_rate_discount', 8, 4);
            $table->decimal('discounted_value', 8, 4);
            $table->decimal('converted_value', 8, 4);
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
        Schema::dropIfExists('exchanges');
    }
};
