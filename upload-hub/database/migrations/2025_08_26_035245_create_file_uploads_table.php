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
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('original_name');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('rows_expected')->nullable();
            $table->unsignedBigInteger('rows_processed')->default(0);
            $table->integer('status')->default(0)->comment('0: pending, 1: processing, 2: completed, 3: failed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_uploads');
    }
};
