<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotations', function (Blueprint $table) {
            $table->id();
            $table->string('origin_currency')->nullable();
            $table->string('destination_currency')->nullable();
            $table->decimal('conversion_amount', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('currency_rate', 10, 2)->nullable();
            $table->decimal('purchase_amount', 10, 2)->nullable();
            $table->decimal('total_purchase_amount', 10, 2)->nullable();
            $table->decimal('payment_fee', 10, 2)->nullable();
            $table->decimal('conversion_fee', 10, 2)->nullable();
            $table->decimal('amount_minus_fee', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotations');
    }
};
