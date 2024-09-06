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
        Schema::create('file_contents', function (Blueprint $table) {
            $table->id();
            $table->string('tckr_symb');
            $table->date('rpt_dt');
            $table->string('mkt_nm');
            $table->string('scty_ctgy_nm');
            $table->string('isin');
            $table->string('crpn_nm');
            $table->foreignId('upload_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_contents');
    }
};
