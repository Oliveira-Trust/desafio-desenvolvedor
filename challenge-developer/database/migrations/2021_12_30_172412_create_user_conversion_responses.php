<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserConversionResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_conversion_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_conversion_id')->index();
            $table->decimal('currency_value', 10,2)->nullable();
            $table->decimal('purchased_value', 10,2)->nullable();
            $table->decimal('pay_rate', 10,2)->nullable();
            $table->decimal('conversion_rate', 10,2)->nullable();
            $table->decimal('value_without_fees', 10,2)->nullable();
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
        Schema::dropIfExists('user_conversion_responses');
    }
}
