<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('currencies', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('available_to_buy');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('currencies');
    }
};
