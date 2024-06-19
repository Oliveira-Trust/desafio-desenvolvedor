<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->increments('ID_TAXA'); // Campo ID_TAXA como chave primária auto-incremento
            $table->string('TAXA'); // Campo TAXA do tipo string
            $table->string('DESC_TAXA'); // Campo DESC_TAXA do tipo string
            $table->double('VALOR'); // Campo VALOR do tipo double sem limitar o número de casas decimais
            $table->timestamps(); // Campos created_at e updated_at
        });

        // Inserir os dados na tabela taxas
        DB::table('taxas')->insert([
            ['ID_TAXA' => 1, 'TAXA' => 'BO', 'DESC_TAXA' => 'Boleto', 'VALOR' => 0.0145, 'created_at' => null, 'updated_at' => null],
            ['ID_TAXA' => 2, 'TAXA' => 'CC', 'DESC_TAXA' => 'Cartão de Crédito', 'VALOR' => 0.0763, 'created_at' => null, 'updated_at' => null],
            ['ID_TAXA' => 3, 'TAXA' => 'CMA', 'DESC_TAXA' => 'Conversão maior que 3 mil', 'VALOR' => 0.01, 'created_at' => null, 'updated_at' => null],
            ['ID_TAXA' => 4, 'TAXA' => 'CME', 'DESC_TAXA' => 'Conversão menor que 3 mil', 'VALOR' => 0.02, 'created_at' => null, 'updated_at' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxas');
    }
}
