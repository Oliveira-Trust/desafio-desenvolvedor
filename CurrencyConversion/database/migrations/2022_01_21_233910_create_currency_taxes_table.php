<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('con_reg_taxes', function (Blueprint $table) 
        {
            $table->id();

            $table->decimal('less_value', 10, 2);
            $table->decimal('less_tax', 10, 2);

            $table->decimal('bigger_value', 10, 2);
            $table->decimal('bigger_tax', 10, 2);

            $table->decimal('tax_credit_card', 10, 2);
            $table->decimal('tax_bank_slip', 10, 2);


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