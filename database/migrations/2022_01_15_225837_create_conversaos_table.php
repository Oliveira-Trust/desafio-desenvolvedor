<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversaos', function (Blueprint $table) {
            $table->id();
            $table->string('moedaorigem');
            $table->decimal('valororigem');
            $table->string('moedadestino');
            $table->decimal('cotacaoatual');
            $table->string('formadepagamento');
            $table->decimal('taxadepagamento');
            $table->decimal('taxadeconversao');
            $table->decimal('valorconversao');
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
        Schema::dropIfExists('conversaos');
    }
}
