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
        Schema::create('conversion_fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('lower_than_threshold', 5, 2);
            $table->decimal('greater_than_threshold', 5, 2);
            $table->decimal('amount_threshold', 10, 2);
            $table->timestamp('effective_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversion_fees');
    }
};
