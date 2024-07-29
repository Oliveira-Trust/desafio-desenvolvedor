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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('origin_currency');
            $table->string('destination_currency');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method');
            $table->decimal('exchange_rate', 15, 6);
            $table->decimal('converted_amount', 15, 2);
            $table->decimal('payment_fee', 15, 2);
            $table->decimal('conversion_fee', 15, 2);
            $table->decimal('final_amount_for_conversion', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
