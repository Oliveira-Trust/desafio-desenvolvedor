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
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('hash', 64)->unique();
            $table->enum('status', ['pending', 'processing', 'done', 'failed'])->default('pending');
            $table->date('reference_date')->nullable();
            $table->unsignedInteger('total_rows')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index('original_name');
            $table->index('reference_date');
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
