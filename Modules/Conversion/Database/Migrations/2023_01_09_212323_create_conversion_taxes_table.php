<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Conversion\Database\Seeders\ConversionDatabaseSeeder;

return new class extends Migration {

    public function up() {
        Schema::create('conversion_taxes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->decimal('value', 3);
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        (new ConversionDatabaseSeeder())->run();
    }

    public function down() {
        Schema::dropIfExists('conversion_taxes');
    }
};
