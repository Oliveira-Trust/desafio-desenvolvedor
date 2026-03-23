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
        Schema::table('uploads', function (Blueprint $table) {
            $table->date('reference_date')->nullable()->after('status');
            $table->index('reference_date');
        });

        DB::table('market_data')
            ->selectRaw('upload_id, MIN(rpt_dt) as reference_date')
            ->groupBy('upload_id')
            ->orderBy('upload_id')
            ->get()
            ->each(function (object $row): void {
                DB::table('uploads')
                    ->where('id', $row->upload_id)
                    ->update(['reference_date' => $row->reference_date]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->dropIndex(['reference_date']);
            $table->dropColumn('reference_date');
        });
    }
};
