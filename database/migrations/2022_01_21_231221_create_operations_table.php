<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('value_for_conversion');
            $table->decimal('converted_value');
            $table->decimal('target_currency_value');
            $table->decimal('payment_rate');
            $table->decimal('conversion_rate');
            $table->decimal('value_for_conversion_minus_rate');

            
            ## CONNECTING COLUMNS ##
            // $table->integer('source_currency_id');
            // $table->integer('target_currency_id');
            // $table->integer('form_of_payment_id');
            // $table->integer('user_id');

            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('source_currency_id')->unsigned();
            $table->foreign('source_currency_id')->references('id')->on('coins')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('target_currency_id')->unsigned();
            $table->foreign('target_currency_id')->references('id')->on('coins')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('form_of_payment_id')->unsigned();
            $table->foreign('form_of_payment_id')->references('id')->on('form_of_payments')->onDelete('cascade')->onUpdate('cascade');
            

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('operations');
    }
}
