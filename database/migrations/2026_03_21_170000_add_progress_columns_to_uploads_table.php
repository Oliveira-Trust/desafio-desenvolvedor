<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->unsignedBigInteger('processed_rows')->default(0)->after('status');
            $table->unsignedBigInteger('failed_rows')->default(0)->after('processed_rows');
        });
    }

    public function down(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->dropColumn(['processed_rows', 'failed_rows']);
        });
    }
};
