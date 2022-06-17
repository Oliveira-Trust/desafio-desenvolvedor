<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMoedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moedas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_moeda');
            $table->string('abreviacao_moeda');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
        DB::insert('insert into moedas (id, nome_moeda, abreviacao_moeda) values (?, ?, ?)', [1, 'Dólar Americano', 'USD']);
        DB::insert('insert into moedas (id, nome_moeda, abreviacao_moeda) values (?, ?, ?)', [2, 'Bitcoin', 'BTC']);
        DB::insert('insert into moedas (id, nome_moeda, abreviacao_moeda) values (?, ?, ?)', [3, 'Euro', 'EUR']);
        DB::insert('insert into moedas (id, nome_moeda, abreviacao_moeda) values (?, ?, ?)', [4, 'Real', 'BRL']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moedas');
    }
}
