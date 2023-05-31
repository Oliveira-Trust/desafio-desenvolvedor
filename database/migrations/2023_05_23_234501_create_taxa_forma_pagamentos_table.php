<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxaFormaPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxa_forma_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_forma_pagamento');
            $table->string('descricao');
            $table->decimal('taxa', 10, 2);
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
        Schema::dropIfExists('taxa_forma_pagamentos');
    }
}
