<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up()
     {
         Schema::create('currency_conversions', function (Blueprint $table) {
             $table->id();
             $table->decimal('conversion_value', 10, 2)->comment('The value for conversion');
             $table->integer('payment_type')->default(1)->comment('The payment type, with 1 for boleto and 2 for card');
             $table->string('source_currency')->default('BRL')->comment('The source currency');
             $table->string('target_currency')->comment('The target currency');
             $table->decimal('value_target_currency', 10, 2)->comment('Value of the target currency');
             $table->decimal('value_payment_fee', 10, 2)->comment('Value of the payment fee');
             $table->decimal('value_conversion_fee', 10, 2)->comment('Value of the conversion fee');
             $table->decimal('purchased_value', 10, 2)->comment('The purchased value in the target currency');
             $table->decimal('value_conversion_deductiong_fee', 10, 2)->comment('Value used for conversion after deducting fee');
             $table->bigInteger('user_id')->unsigned();
             $table->foreign('user_id')->references('id')->on('users');
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
         Schema::dropIfExists('currency_conversions');
     }
}
