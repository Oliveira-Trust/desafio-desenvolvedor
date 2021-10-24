<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterTableCotacoesTaxasRangesChangeValMinimoChangeValMaximo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `cotacoes_taxas_ranges` MODIFY `val_minimo` DOUBLE(15, 2)');
        DB::statement('ALTER TABLE `cotacoes_taxas_ranges` MODIFY `val_maximo` DOUBLE(15, 2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `cotacoes_taxas_ranges` MODIFY `val_minimo` DOUBLE(8, 2)');
        DB::statement('ALTER TABLE `cotacoes_taxas_ranges` MODIFY `val_maximo` DOUBLE(8, 2)');
    }
}
