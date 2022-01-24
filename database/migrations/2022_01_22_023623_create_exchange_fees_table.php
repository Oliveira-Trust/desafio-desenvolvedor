<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeFeesTable extends Migration
{
    public function up()
    {
        Schema::create('exchange_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('min_amount');
            $table->unsignedBigInteger('max_amount');
            $table->decimal('fees');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchange_fees');
    }
}
