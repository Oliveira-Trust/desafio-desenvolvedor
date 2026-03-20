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
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_upload_id')->constrained()->cascadeOnDelete();
            $table->date('RptDt');
            $table->string('TckrSymb', 20);
            $table->string('MktNm', 100)->nullable();
            $table->string('SctyCtgyNm', 50)->nullable();
            $table->string('ISIN', 20)->nullable();
            $table->string('CrpnNm', 255)->nullable();
            $table->timestamps();

            $table->index(['TckrSymb', 'RptDt']);
            $table->index('RptDt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruments');
    }
};
