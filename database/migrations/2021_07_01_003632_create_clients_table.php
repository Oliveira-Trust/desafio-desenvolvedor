<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            $table->string('document', 25);
            $table->string('phone_number', 25);
            $table->string('phone_number2', 25);
            $table->string('birth', 10);

            $table->string('address_zipcode');
            $table->string('address_street');
            $table->integer('address_number')->default(0);
            $table->string('address_complement')->nullable();
            $table->string('address_neighborhood');
            $table->unsignedBigInteger('city_id');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
