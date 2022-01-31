<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
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
        Schema::connection($this->connection)->create('taxes', function (Blueprint $table) {
            $table->uuid('id')->default(\DB::raw("'uuid_generate_v4()'"));
            $table->primary('id');
            $table->uuid('setup_id');
            $table->string('name')->default('default');
            $table->decimal('value', 4)->default(0.0000);
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
        Schema::connection($this->connection)->dropIfExists('taxes');
    }
}
