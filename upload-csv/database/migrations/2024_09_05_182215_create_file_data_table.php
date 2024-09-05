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
        Schema::create('file_data', function (Blueprint $table) {
            $table->id();
            $table->date('RptDt');
            $table->string('TckrSymb');
            $table->string('MktNm');
            $table->string('SctyCtgyNm');
            $table->string('ISIN');
            $table->string('CrpnNm');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_data');
    }
};
