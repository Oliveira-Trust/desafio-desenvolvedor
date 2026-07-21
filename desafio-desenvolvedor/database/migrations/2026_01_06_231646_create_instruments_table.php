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
            $table->foreignId('file_upload_id')->constrained()->onDelete('cascade');
            $table->date('rpt_dt');
            $table->string('tckr_symb');
            $table->string('mkt_nm')->nullable();
            $table->string('scty_ctgy_nm')->nullable();
            $table->string('isin')->nullable();
            $table->string('crpn_nm')->nullable();
            $table->timestamps();

            // indices para otimização de buscas
            $table->index('rpt_dt');
            $table->index('tckr_symb');
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
