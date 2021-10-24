<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterTableCotacoesTaxasChangePerCotacaoTaxa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `cotacoes_taxas` MODIFY `per_cotacao_taxa` DOUBLE(5, 2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `cotacoes_taxas` MODIFY `per_cotacao_taxa` DOUBLE(3, 2)');
    }
}
