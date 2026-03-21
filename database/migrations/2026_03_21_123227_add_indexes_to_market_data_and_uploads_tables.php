<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('market_data', function (Blueprint $table) {
            $table->index(['tckr_symb', 'rpt_dt']);
            $table->index('rpt_dt');
        });

        Schema::table('uploads', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('market_data', function (Blueprint $table) {
            $table->dropIndex(['tckr_symb', 'rpt_dt']);
            $table->dropIndex(['rpt_dt']);
        });

        Schema::table('uploads', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
        });
    }
};