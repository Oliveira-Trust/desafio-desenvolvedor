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
         Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('hash')->unique();
            $table->timestamp('uploaded_at')->useCurrent();
            $table->string('uploaded_by')->nullable(); // pode ser user_id ou token
            $table->string('path');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
