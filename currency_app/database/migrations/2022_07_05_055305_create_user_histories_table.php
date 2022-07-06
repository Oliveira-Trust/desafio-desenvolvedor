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
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();

            $table->string('origin_currency', 6);
            $table->string('destination_currency', 6);
            $table->float('value')->comment('valor da conversao');
            $table->string('payment_method');
            $table->float('destination_currency_price');
            $table->float('selling_price');
            $table->float('payment_method_fee');
            $table->float('convertion_fee');
            $table->float('discounted_value');
            $table->foreignId('user_id')->constrained()->restrictOnDelete();

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
        Schema::dropIfExists('user_histories');
    }
};
