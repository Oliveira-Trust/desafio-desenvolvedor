<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tax_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->decimal('boleto_fee')->default(1.45);
            $table->decimal('credit_card_fee')->default(7.63);
            $table->decimal('conversion_fee_below_3000')->default(2.00);
            $table->decimal('conversion_fee_above_3000')->default(1.00);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_settings');
    }
};
