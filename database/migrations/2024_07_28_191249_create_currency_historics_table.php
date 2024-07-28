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
        Schema::create('currency_historics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('source_currency', 3)->default('BRL');
            $table->string('destination_currency', 3);
            $table->decimal('amount', 15, 2);
            $table->string('payment_method', 10);
            $table->decimal('rate', 15, 8);
            $table->decimal('converted_amount', 15, 8);
            $table->decimal('tax_payment', 15, 2);
            $table->decimal('tax_conversion', 15, 2);
            $table->decimal('amount_after_taxes', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_historics');
    }
};
