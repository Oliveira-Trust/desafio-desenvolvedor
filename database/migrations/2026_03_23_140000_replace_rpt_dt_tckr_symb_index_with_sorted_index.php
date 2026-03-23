<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP INDEX market_data_rpt_dt_tckr_symb_index ON market_data');
        DB::statement('CREATE INDEX market_data_rpt_dt_desc_tckr_symb_asc_index ON market_data (rpt_dt DESC, tckr_symb ASC)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX market_data_rpt_dt_desc_tckr_symb_asc_index ON market_data');
        DB::statement('CREATE INDEX market_data_rpt_dt_tckr_symb_index ON market_data (rpt_dt, tckr_symb)');
    }
};
