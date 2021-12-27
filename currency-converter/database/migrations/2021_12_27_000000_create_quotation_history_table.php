<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_history', function (Blueprint $table) {
            $table->id();
            $table->string('destiny_currency');
            $table->string('value_for_conversion');
            $table->string('payment_method');
            $table->unsignedBigInteger('created_by');

            $table->foreign('created_by')->references('id')->on('users');

            $table->rememberToken();
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
        Schema::dropIfExists('quotation_history');
    }
}
