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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->unsignedBigInteger('user_id');
            $table->string('origin_currency', 5);
            $table->string('destination_currency', 5);
            $table->integer('amount_in_cents');
            $table->string('payment_method', 30);
            $table->integer('payment_fee');
            $table->integer('conversion_fee');
            $table->decimal('converted_amount');
            $table->decimal('value_of_used_currency');
            $table->decimal('value_of_destination_currency');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
