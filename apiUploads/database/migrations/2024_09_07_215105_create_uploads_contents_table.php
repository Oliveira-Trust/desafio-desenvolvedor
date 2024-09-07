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
        Schema::create('uploads_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUpload');
            $table->string('rptDt')->nullable();
            $table->string('tckrSymb')->nullable();
            $table->string('mktNm')->nullable();
            $table->string('sctyCtgyNm')->nullable();
            $table->string('iSIN')->nullable();
            $table->string('crpnNm')->nullable();
            $table->timestamps();

            $table->foreign('idUpload')->references('id')->on('uploads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads_contents');
    }
};
