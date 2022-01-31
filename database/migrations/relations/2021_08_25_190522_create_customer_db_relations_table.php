<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDBRelationsTable extends Migration
{
    public function __construct()
    {
        $this->connection = config('acustomer.connection');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table('customer_exchanges', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::connection($this->connection)->table('users', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
