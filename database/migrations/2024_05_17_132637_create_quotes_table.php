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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('currency_origin', 3);
            $table->string('currency_name', 3);
            $table->string('payment_method');
            $table->decimal('conversion_amount', 15, 2);
            $table->double('fee');
            $table->double('currency_value');
            $table->double('conversion_fee');
            $table->double('payment_rate');
            $table->double('conversion_rate');
            $table->double('conversion_value');
            $table->double('converted_amount');
            $table->foreignId('user_id')->constrained(table: 'users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
