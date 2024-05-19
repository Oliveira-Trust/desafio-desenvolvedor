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
            $table->string('currency');
            $table->string('target_currency');
            $table->decimal('amount');
            $table->decimal('payment_fee');
            $table->decimal('amount_fee');
            $table->decimal('bid');
            $table->decimal('target_amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
