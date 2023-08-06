<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('target_coin');
            $table->string('source_coin');
            $table->enum('payment_method', ['bill', 'credit_card']);
            $table->float('converted_value');
            $table->float('actual_cotation');
            $table->float('conversion_tax');
            $table->float('payment_tax');
            $table->float('value');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_conversions');
    }
};
