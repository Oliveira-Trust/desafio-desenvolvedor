<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('fees', function(Blueprint $table) {
            $table->id();
            $table->float('starting_value', 20, 2);
            $table->float('fee_rate', 8, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('taxes');
    }
};
