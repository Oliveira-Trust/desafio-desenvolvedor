<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTaxaConversaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxa_conversao', function (Blueprint $table) {
            $table->id();
            $table->double('valor_limite');
            $table->double('taxa_abaixo');
            $table->double('taxa_acima');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });

        DB::insert('insert into taxa_conversao (id, valor_limite,taxa_abaixo, taxa_acima) values (?, ?, ?, ?)', [1, '3000', '0.02', '0.01']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxa_conversao');
    }
}
