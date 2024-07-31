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
        Schema::create('taxa_valor_compra', function (Blueprint $table) {
            $table->id();
            $table->float('valor_base', 8, 2);
            $table->decimal('taxa_menor_valor', 2, 3);
            $table->decimal('taxa_maior_valor', 2, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxa_valor_compra');
    }
};
