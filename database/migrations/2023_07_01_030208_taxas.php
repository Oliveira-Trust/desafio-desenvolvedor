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
        Schema::create('taxas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',40); 
            $table->decimal('valor', $precision = 10, $scale = 2);
            $table->timestamps();
            $table->boolean('ativo'); 
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        DB::table('taxas')->insert(
            array(
                'tipo' => 'Boleto',
                'valor' => "1.45",
                'ativo' => true
            ),            
        );

        DB::table('taxas')->insert(
            array(
                'tipo' => 'Cartão',
                'valor' => "7.63",
                'ativo' => true
            ),
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxas');
    }
};
