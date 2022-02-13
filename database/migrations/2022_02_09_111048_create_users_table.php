<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create(
            'users',
            function (Blueprint $table): void {
                $table->id();
                $table->string('name', 95);
                $table->string('email')->unique()->notNullable();
                $table->string('password');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
