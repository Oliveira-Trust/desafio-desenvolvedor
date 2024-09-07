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
        Schema::table('uploads', function (Blueprint $table) {
            $table->dropColumn([
                'rptDt',
                'tckrSymb',
                'mktNm',
                'sctyCtgyNm',
                'iSIN',
                'crpnNm'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->string('rptDt')->nullable()->after('rptDt');
            $table->string('tckrSymb')->nullable()->after('tckrSymb');
            $table->string('mktNm')->nullable()->after('mktNm');
            $table->string('sctyCtgyNm')->nullable()->after('sctyCtgyNm');
            $table->string('iSIN')->nullable()->after('iSIN');
            $table->string('crpnNm')->nullable()->after('crpnNm');
        });
    }
};
