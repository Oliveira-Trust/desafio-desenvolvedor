<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserConversions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('currency_origin')->nullable();
            $table->string('currency_destiny')->nullable();
            $table->decimal('value', 10,2)->nullable();
            $table->string('payment_method')->nullable();
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
        Schema::dropIfExists('user_conversions');
    }
}
