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
        Schema::create('currency_purchase_conversion_fee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_purchase_id');
            $table->foreign('currency_purchase_id')->references('id')->on('currency_purchases')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('conversion_fee_id');
            $table->foreign('conversion_fee_id')->references('id')->on('conversion_fees')->onDelete('cascade')->onUpdate('cascade');
            $table->float('convertion_fee', 5, 2)->nullable();
            $table->float('convertion_fee_value', 10, 2)->nullable();
            $table->string('conversion_rule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_purchase_conversion_fee');
    }
};
