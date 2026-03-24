<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('market_data', function (Blueprint $table) {
                $table->dropIndex('market_data_rpt_dt_tckr_symb_index');
                $table->index(['rpt_dt', 'tckr_symb'], 'market_data_rpt_dt_desc_tckr_symb_asc_index');
            });

            return;
        }

        DB::statement('DROP INDEX market_data_rpt_dt_tckr_symb_index ON market_data');
        DB::statement('CREATE INDEX market_data_rpt_dt_desc_tckr_symb_asc_index ON market_data (rpt_dt DESC, tckr_symb ASC)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('market_data', function (Blueprint $table) {
                $table->dropIndex('market_data_rpt_dt_desc_tckr_symb_asc_index');
                $table->index(['rpt_dt', 'tckr_symb'], 'market_data_rpt_dt_tckr_symb_index');
            });

            return;
        }

        DB::statement('DROP INDEX market_data_rpt_dt_desc_tckr_symb_asc_index ON market_data');
        DB::statement('CREATE INDEX market_data_rpt_dt_tckr_symb_index ON market_data (rpt_dt, tckr_symb)');
    }
};
