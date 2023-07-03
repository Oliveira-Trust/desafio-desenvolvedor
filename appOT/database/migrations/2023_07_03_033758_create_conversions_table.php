<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionsTable extends Migration
{
    public function up()
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->string('origin_currency')->default('BRL');
            $table->string('destination_currency');
            $table->float('conversion_value');
            $table->float('converted_value');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversions');
    }
}
