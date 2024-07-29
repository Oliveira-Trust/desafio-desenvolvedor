<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('source_currency')->index()->default('BRL');
            $table->string('target_currency')->index();
            $table->decimal('original_amount');
            $table->string('payment_method')->index();
            $table->decimal('payment_fee');
            $table->decimal('conversion_fee');
            $table->decimal('converted_amount');
            $table->decimal('value_target_currency');
            $table->decimal('final_amount');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotes');
    }
};
