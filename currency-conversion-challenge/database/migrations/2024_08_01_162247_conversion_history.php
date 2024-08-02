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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->float('amount', 15, 2);
            $table->string('payment_method');
            $table->float('currency_value', 15, 2);
            $table->float('purchase_amount', 15, 2);
            $table->float('conversion_rate', 10, 6);
            $table->float('payment_rate', 10, 6);
            $table->float('purchase_price_excluding_taxes', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversion_history');
    }
};
