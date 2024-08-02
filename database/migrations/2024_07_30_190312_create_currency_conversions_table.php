<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currency_conversions', function (Blueprint $table) {
            $table->id();
            $table->char('destination_currency', 3);
            $table->decimal('value_conversion', 10, 2);
            $table->unsignedBigInteger('payment_method_id');
            $table->decimal('value_currency_conversion', 10, 2);
            $table->decimal('purchased_value_currency', 10, 2);
            $table->decimal('payment_rate', 10, 2);
            $table->decimal('conversion_rate', 10, 2);
            $table->decimal('amount_conversions_subtracting_fees', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_conversions');
    }
};
