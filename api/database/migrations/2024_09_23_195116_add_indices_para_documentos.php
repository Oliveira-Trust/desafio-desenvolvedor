<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table('documentos', function (Blueprint $collection) {
            $collection->createIndex(['RptDt' => 1]);
            $collection->createIndex(['TckrSymb' => 1]);
            $collection->createIndex(['MktNm' => 1]);
            $collection->createIndex(['SctyCtgyNm' => 1]);
            $collection->createIndex(['ISIN' => 1]);
            $collection->createIndex(['CrpnNm' => 1]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('documentos', function (Blueprint $collection) {

        $collection->dropIndex(['RptDt' => 1]);
        $collection->dropIndex(['TckrSymb' => 1]);
        $collection->dropIndex(['MktNm' => 1]);
        $collection->dropIndex(['SctyCtgyNm' => 1]);
        $collection->dropIndex(['ISIN' => 1]);
        $collection->dropIndex(['CrpnNm' => 1]);
        });
    }
};
