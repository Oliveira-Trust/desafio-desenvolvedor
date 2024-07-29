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
        Schema::create('exchange_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('destination_currency');
            $table->decimal('amount', 10, 2);
            $table->decimal('conversion_rate', 10, 4);
            $table->decimal('converted_amount', 10, 2);
            $table->decimal('payment_fee', 10, 2);
            $table->decimal('conversion_fee', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->string('payment_method');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_histories');
    }
};
