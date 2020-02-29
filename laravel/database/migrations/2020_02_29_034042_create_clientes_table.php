<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome',100);
            $table->string('email');
            $table->string('senha',30);
            $table->char('telefone',18)->nullable();
            $table->char('celular',19);
            $table->string('sexo',10);
            $table->char('cep',10);
            $table->char('estado',2);
            $table->string('cidade',120);
            $table->string('bairro',120);
            $table->string('logradouro');
            $table->string('numero',10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
