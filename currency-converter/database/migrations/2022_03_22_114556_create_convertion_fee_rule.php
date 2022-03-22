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
        Schema::create('convertion_fee_rule', function (Blueprint $table) {
            $table->id();
            $table->string('comparator', 2)->description('regra de comparacao');
            $table->float('comparable_value', 8, 2)->description('valor que servira como base de comparacao');
            $table->float('fee', 8, 8)->description('taxa ja dividida por 100');
            $table->boolean('active')->default(1)->description('se esta ativa ou nao');
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
        Schema::dropIfExists('convertion_fee_rule');
    }
};
