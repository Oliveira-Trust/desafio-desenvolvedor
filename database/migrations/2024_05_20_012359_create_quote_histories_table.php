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
        Schema::create('quote_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('currency_from', 10);
            $table->string('currency_to', 10);
            $table->decimal('amount', 15, 2);
            $table->decimal('converted_amount', 15, 2);
            $table->string('payment_method', 20);
            $table->decimal('payment_method_fee', 5, 2);
            $table->decimal('conversion_fee', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_histories');
    }
};
