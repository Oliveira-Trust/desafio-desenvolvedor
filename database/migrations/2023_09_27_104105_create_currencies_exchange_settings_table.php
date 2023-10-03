<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currencies_exchange_settings', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->unsignedDouble('boleto_payment_tax', 8, 2);
            $table->unsignedDouble('credit_card_payment_tax', 8, 2);
            $table->unsignedDouble('base_value_conversion_tax', 8, 2);
            $table->unsignedDouble('base_value_greater_conversion_tax', 8, 2);
            $table->unsignedDouble('base_value_lower_conversion_tax', 8, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies_exchange_settings');
    }
};
