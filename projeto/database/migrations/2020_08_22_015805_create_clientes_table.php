<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 50)->nullable(false);
            $table->string('senha', 255)->nullable(false);
            $table->string('nome', 255)->nullable(false);
            $table->string('cpf', 11)->nullable(false);
            $table->string('tel', 21)->nullable(false);
            $table->string('email', 100)->nullable(false);
           
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
