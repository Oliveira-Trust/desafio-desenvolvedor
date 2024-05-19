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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('rate')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->enum('type', ['amount_fee', 'payment_fee']);
            $table->decimal('amount')->nullable();
            $table->decimal('min_amount_rate')->nullable();
            $table->decimal('max_amount_rate')->nullable();
            $table->timestamps();

            $table->foreignId('payment_method_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
