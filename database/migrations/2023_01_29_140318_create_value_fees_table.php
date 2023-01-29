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
        Schema::create('ammount_fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('ammount', 9)->unique();
            $table->decimal('fee', 6);
        });

        DB::table('ammount_fees')->insert(
            [
                ['ammount' => 3000, 'fee' => 2],
                ['ammount' => 0, 'fee' => 1],
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
        Schema::dropIfExists('ammount_fees');
    }
};
