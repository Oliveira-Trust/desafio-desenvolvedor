<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacoes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('codein', 50);
            $table->string('name', 255);
            $table->decimal('high', 5,4);
            $table->decimal('low', 5,4);
            $table->decimal('varBid', 5,4);
            $table->decimal('pctChange', 5,4);
            $table->decimal('bid', 5,4);
            $table->decimal('ask', 5,4);
            $table->string('timestamp', 20);
            $table->dateTime('create_date');
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
        Schema::dropIfExists('cotacoes');
    }
}
