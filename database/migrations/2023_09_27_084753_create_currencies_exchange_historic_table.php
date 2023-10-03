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
        Schema::create('currencies_exchange_historic', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->ulid('user_id');
            $table->string('source_currency', 15);
            $table->string('destination_currency', 15);
            $table->unsignedDouble('currency_bid', 8, 2);
            $table->unsignedDouble('conversion_value', 8, 2);
            $table->enum('payment_type', ['BOLETO', 'CREDIT_CARD']);
            $table->unsignedDouble('payment_tax', 1, 2);
            $table->unsignedDouble('conversion_tax', 1, 2);

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies_exchange_historic');
    }
};
