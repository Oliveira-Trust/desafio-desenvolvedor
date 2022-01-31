<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminDBRelationsTable extends Migration
{
    public function __construct()
    {
        $this->connection = config('admin.connection');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table('taxes', function (Blueprint $table) {
            $table->foreign('setup_id')->references('id')->on('setups');
        });
        Schema::connection($this->connection)->table('tax_intervals', function (Blueprint $table) {
            $table->foreign('tax_id')->references('id')->on('taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::connection($this->connection)->table('taxes', function (Blueprint $table) {
            $table->dropForeign(['setup_id']);
        });

        Schema::connection($this->connection)->table('tax_intervals', function (Blueprint $table) {
            $table->dropForeign(['tax_id']);
        });

    }
}
