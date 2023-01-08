<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('payment_methods', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('fee_rate',8,2)->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('payment_methods');
    }
};
