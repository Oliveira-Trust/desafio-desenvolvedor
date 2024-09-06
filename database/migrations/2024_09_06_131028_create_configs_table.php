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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('taxa_conv_acima');
            $table->string('taxa_conv_abaixo');
            $table->string('taxa_boleto');
            $table->string('taxa_cartao');
            $table->timestamps();
        });

        DB::table('configs')->insert([
            'taxa_conv_acima' => '2,50',
            'taxa_conv_abaixo' => '7,52',
            'taxa_boleto' => '8,50',
            'taxa_cartao' => '1,50',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
