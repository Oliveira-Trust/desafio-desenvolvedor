<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upload_id');
            $table->date('RptDt');
            $table->string('TckrSymb');
            $table->string('Asst')->nullable();
            $table->string('AsstDesc')->nullable();
            $table->string('SgmtNm')->nullable();
            $table->string('MktNm');
            $table->string('SctyCtgyNm');
            $table->date('XprtnDt')->nullable();
            $table->string('XprtnCd')->nullable();
            $table->date('TradgStartDt')->nullable();
            $table->date('TradgEndDt')->nullable();
            $table->string('BaseCd')->nullable();
            $table->string('ConvsCritNm')->nullable();
            $table->string('MtrtyDtTrgtPt')->nullable();
            $table->boolean('ReqrdConvsInd')->nullable();
            $table->string('ISIN');
            $table->string('CFICd')->nullable();
            $table->date('DlvryNtceStartDt')->nullable();
            $table->date('DlvryNtceEndDt')->nullable();
            $table->string('OptnTp')->nullable();
            $table->decimal('CtrctMltplr', 10, 2)->nullable();
            $table->decimal('AsstQtnQty', 10, 2)->nullable();
            $table->string('AllcnRndLot')->nullable();
            $table->string('TradgCcy')->nullable();
            $table->string('DlvryTpNm')->nullable();
            $table->integer('WdrwlDays')->nullable();
            $table->integer('WrkgDays')->nullable();
            $table->integer('ClnrDays')->nullable();
            $table->string('RlvrBasePricNm')->nullable();
            $table->string('OpngFutrPosDay')->nullable();
            $table->string('SdTpCd1')->nullable();
            $table->string('UndrlygTckrSymb1')->nullable();
            $table->string('SdTpCd2')->nullable();
            $table->string('UndrlygTckrSymb2')->nullable();
            $table->decimal('PureGoldWght', 10, 2)->nullable();
            $table->decimal('ExrcPric', 10, 2)->nullable();
            $table->string('OptnStyle')->nullable();
            $table->string('ValTpNm')->nullable();
            $table->boolean('PrmUpfrntInd')->nullable();
            $table->date('OpngPosLmtDt')->nullable();
            $table->string('DstrbtnId')->nullable();
            $table->decimal('PricFctr', 10, 2)->nullable();
            $table->integer('DaysToSttlm')->nullable();
            $table->string('SrsTpNm')->nullable();
            $table->boolean('PrtcnFlg')->nullable();
            $table->boolean('AutomtcExrcInd')->nullable();
            $table->string('SpcfctnCd')->nullable();
            $table->string('CrpnNm');
            $table->date('CorpActnStartDt')->nullable();
            $table->string('CtdyTrtmntTpNm')->nullable();
            $table->decimal('MktCptlstn', 15, 2)->nullable();
            $table->string('CorpGovnLvlNm')->nullable();
            $table->timestamps();

            $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_contents');
    }
}
