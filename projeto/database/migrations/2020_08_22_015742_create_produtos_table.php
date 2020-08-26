<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100)->nullable(false);
            $table->text('descricao')->nullable(false);
            $table->float('preco', 5, 2)->nullable(false);
        });
	}

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
