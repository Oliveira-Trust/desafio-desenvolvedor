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
            $table->uuid('uuid')->primary();
            $table->string('name');
            $table->date('dob');
            $table->string('user_id');
            $table->string('status_id');
            $table->timestamps();
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('uuid')
                ->on('users');
            $table->foreign('status_id')
                ->references('uuid')
                ->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('clients');
    }
}
