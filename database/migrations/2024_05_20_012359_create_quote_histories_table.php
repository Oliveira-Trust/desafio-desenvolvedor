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
            $table->string('origin_currency', 10);
            $table->string('destination_currency', 10);
            $table->string('payment_method', 10);
            $table->bigInteger('original_amount');
            $table->bigInteger('converted_amount');
            $table->bigInteger('exchange_rate');
            $table->bigInteger('tax_rate_value');
            $table->decimal('tax_rate_value_porcentages', 4, 2);
            $table->bigInteger('tax_conversion_value');
            $table->decimal('tax_conversion_percentage', 4, 2);
            $table->bigInteger('tax_total');
            $table->bigInteger('original_value_minus_tax');
            $table->dateTime('email_sent_at')->nullable();
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
