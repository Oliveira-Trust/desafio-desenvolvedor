<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->char('code', 3)->default('BRL');
            $table->char('code_in', 3);
            $table->decimal('conversion_value');
            $table->decimal('payment_rate');
            $table->decimal('conversion_rate');
            $table->decimal('conversion_value_tax');
            $table->decimal('purchased_value');
            $table->decimal('destination_currency_value');
            $table->float('tax');
            $table->string('payment_method', 25);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
