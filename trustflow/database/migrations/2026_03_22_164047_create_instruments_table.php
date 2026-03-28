<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upload_history_id')->constrained("upload_histories")->onDelete('cascade');
            
            $table->date('RptDt');
            $table->string('TckrSymb');
            $table->string('Asst')->nullable();
            $table->string('AsstDesc')->nullable();
            $table->string('SgmtNm')->nullable();
            $table->string('MktNm')->nullable();
            $table->string('SctyCtgyNm')->nullable();
            $table->date('XprtnDt')->nullable();
            $table->string('XprtnCd')->nullable();
            $table->date('TradgStartDt')->nullable();
            $table->date('TradgEndDt')->nullable();
            $table->integer('BaseCd')->nullable();
            $table->string('ConvsCritNm')->nullable();
            $table->integer('MtrtyDtTrgtPt')->nullable();
            $table->string('ReqrdConvsInd')->nullable();
            $table->string('ISIN')->nullable();
            $table->string('CFICd')->nullable();
            $table->date('DlvryNtceStartDt')->nullable();
            $table->date('DlvryNtceEndDt')->nullable();
            $table->string('OptnTp')->nullable();
            $table->decimal('CtrctMltplr', 18, 8)->nullable();
            $table->integer('AsstQtnQty')->nullable();
            $table->integer('AllcnRndLot')->nullable();
            $table->string('TradgCcy', 5)->nullable();
            $table->string('DlvryTpNm')->nullable();
            $table->integer('WdrwlDays')->nullable();
            $table->integer('WrkgDays')->nullable();
            $table->integer('ClnrDays')->nullable();
            $table->string('RlvrBasePricNm')->nullable();
            $table->integer('OpngFutrPosDay')->nullable();
            $table->string('SdTpCd1')->nullable();
            $table->string('UndrlygTckrSymb1')->nullable();
            $table->string('SdTpCd2')->nullable();
            $table->string('UndrlygTckrSymb2')->nullable();
            $table->string('PureGoldWght')->nullable();
            $table->decimal('ExrcPric', 18, 8)->nullable();
            $table->string('OptnStyle')->nullable();
            $table->string('ValTpNm')->nullable();
            $table->string('PrmUpfrntInd')->nullable();
            $table->date('OpngPosLmtDt')->nullable();
            $table->integer('DstrbtnId')->nullable();
            $table->integer('PricFctr')->nullable();
            $table->integer('DaysToSttlm')->nullable();
            $table->string('SrsTpNm')->nullable();
            $table->string('PrtcnFlg')->nullable();
            $table->string('AutomtcExrcInd')->nullable();
            $table->string('SpcfctnCd')->nullable();
            $table->string('CrpnNm', 300)->nullable();
            $table->date('CorpActnStartDt')->nullable();
            $table->string('CtdyTrtmntTpNm')->nullable();
            $table->bigInteger('MktCptlstn')->nullable();
            $table->string('CorpGovnLvlNm')->nullable();

            $table->index(['RptDt', 'TckrSymb']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruments');
    }
};