<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUsersTable extends Migration
{
    /**
     * CreateUsersTable constructor.
     */
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
        Schema::connection($this->connection)->create('users', function (Blueprint $table) {
            $table->uuid('id')->default(\DB::raw("'uuid_generate_v4()'"));
            $table->primary('id');
            $table->uuid('customer_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->default('now()');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->dropIfExists('users');
    }
}
