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
        Schema::create('con_reg_conversions', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('origin_currency')->default(1);
            $table->integer('cur_id')->unsigned();
            $table->decimal('origin_value', 10, 2);
            $table->enum('payment_method', ['CREDIT_CARD', 'BANK_SLIP']);
            $table->decimal('tax_currency', 10, 2);
            $table->decimal('tax_payment_method', 10, 2);
            $table->decimal('tax_conversion', 10, 2);
            $table->decimal('converted_value', 10, 2);
            $table->decimal('updated_value', 10, 2);
            $table->integer('usu_id')->unsigned();
            $table->foreign('usu_id')->references('id')->on('adm_usr_users')->onDelete('cascade');
            $table->foreign('cur_id')->references('id')->on('con_reg_currencies')->onDelete('cascade');


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
        Schema::dropIfExists('con_reg_conversions');
    }
}