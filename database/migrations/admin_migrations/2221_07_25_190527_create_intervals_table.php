<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervalsTable extends Migration
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
        Schema::connection($this->connection)->create('tax_intervals', function (Blueprint $table) {
            $table->uuid('id')->default(\DB::raw("'uuid_generate_v4()'"));
            $table->primary('id');
            $table->uuid('tax_id');
            $table->decimal('min', 4)->nullable();
            $table->decimal('max', 4)->nullable();
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
        Schema::connection($this->connection)->dropIfExists('tax_intervals');
    }
}
