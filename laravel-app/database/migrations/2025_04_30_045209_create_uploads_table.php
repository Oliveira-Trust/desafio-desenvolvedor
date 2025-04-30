<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_hash');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->date('reference_date')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->integer('total_records')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
};
