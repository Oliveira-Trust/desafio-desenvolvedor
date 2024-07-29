<?php

use App\Models\User;
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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->decimal('valor', 10, 2);
            $table->string('moeda_origem', 3)->default('BRL');
            $table->string('moeda_destino', 3);
            $table->decimal('taxa_cambio', 10, 6);
            $table->decimal('taxa_pagamento', 10, 2);
            $table->decimal('taxa_conversao', 10, 2);
            $table->decimal('taxas_totais', 10, 2);
            $table->decimal('valor_final', 10, 2);
            $table->decimal('valor_convertido', 10, 2);
            $table->string('forma_pagamento');
            $table->foreignIdFor(User::class)->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
