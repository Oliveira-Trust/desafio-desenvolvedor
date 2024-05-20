<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('conversion_rates_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('payment_method', 20);
            $table->decimal('payment_method_fee', 5, 2);
            $table->decimal('conversion_fee_threshold', 10, 2);
            $table->decimal('conversion_fee_below_threshold', 5, 2);
            $table->decimal('conversion_fee_above_threshold', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversion_rates_configurations');
    }
};
