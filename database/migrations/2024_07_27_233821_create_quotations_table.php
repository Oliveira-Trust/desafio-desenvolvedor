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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->string('origin_currency');
            $table->string('destination_currency');
            $table->decimal('quotation', 8, 2)->default(0);
            $table->decimal('payment_tax', 8, 2)->default(0);
            $table->decimal('conversion_tax', 8, 2)->default(0);
            $table->decimal('conversion_amount', 8, 2)->default(0);
            $table->decimal('conversion_net_amount', 8, 2)->default(0);
            $table->decimal('destination_currency_available', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
