<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('value');
            $table->string('type');
            $table->string('user_id');
            $table->string('client_id');
            $table->string('status_id');
            $table->timestamps();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('uuid')
                ->on('users');
            $table->foreign('client_id')
                ->references('uuid')
                ->on('clients');
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('contacts');
    }
}
