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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3);
            $table->string('name', 50);
        });

        DB::table('currencies')->insert(
            [
                ['code' => 'USD', 'name' => 'Dollar americano'],
                ['code' => 'EUR', 'name' => 'Euro'],
                ['code' => 'GBP', 'name' => 'Libra Esterlina'],
            ]
        );


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
