<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instruments_consolidate_file_content', function (Blueprint $table) {
            $table->string('RptDt');
            $table->string('TckrSymb');
            $table->string('MktNm');
            $table->string('SctyCtgyNm');
            $table->string('ISIN');
            $table->string('CrpnNm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruments_consolidate_file_content');
    }
};
