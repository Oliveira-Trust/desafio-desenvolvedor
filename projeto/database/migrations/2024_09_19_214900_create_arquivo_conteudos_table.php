<?php

use App\Models\Arquivo;
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
        Schema::create('arquivo_conteudos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Arquivo::class);
            $table->string('RptDt')->nullable()->index();
            $table->string('TckrSymb')->nullable()->index();
            $table->string('Asst')->nullable();
            $table->string('AsstDesc')->nullable();
            $table->string('SgmtNm')->nullable();
            $table->string('MktNm')->nullable();
            $table->string('SctyCtgyNm')->nullable();
            $table->string('XprtnDt')->nullable();
            $table->string('XprtnCd')->nullable();
            $table->string('TradgStartDt')->nullable();
            $table->string('TradgEndDt')->nullable();
            $table->string('BaseCd')->nullable();
            $table->string('ConvsCritNm')->nullable();
            $table->string('MtrtyDtTrgtPt')->nullable();
            $table->string('ReqrdConvsInd')->nullable();
            $table->string('ISIN')->nullable()->index();
            $table->string('CFICd')->nullable();
            $table->string('DlvryNtceStartDt')->nullable();
            $table->string('DlvryNtceEndDt')->nullable();
            $table->string('OptnTp')->nullable();
            $table->string('CtrctMltplr')->nullable();
            $table->string('AsstQtnQty')->nullable();
            $table->string('AllcnRndLot')->nullable();
            $table->string('TradgCcy')->nullable();
            $table->string('DlvryTpNm')->nullable();
            $table->string('WdrwlDays')->nullable();
            $table->string('WrkgDays')->nullable();
            $table->string('ClnrDays')->nullable();
            $table->string('RlvrBasePricNm')->nullable();
            $table->string('OpngFutrPosDay')->nullable();
            $table->string('SdTpCd1')->nullable();
            $table->string('UndrlygTckrSymb1')->nullable();
            $table->string('SdTpCd2')->nullable();
            $table->string('UndrlygTckrSymb2')->nullable();
            $table->string('PureGoldWght')->nullable();
            $table->string('ExrcPric')->nullable();
            $table->string('OptnStyle')->nullable();
            $table->string('ValTpNm')->nullable();
            $table->string('PrmUpfrntInd')->nullable();
            $table->string('OpngPosLmtDt')->nullable();
            $table->string('DstrbtnId')->nullable();
            $table->string('PricFctr')->nullable();
            $table->string('DaysToSttlm')->nullable();
            $table->string('SrsTpNm')->nullable();
            $table->string('PrtcnFlg')->nullable();
            $table->string('AutomtcExrcInd')->nullable();
            $table->string('SpcfctnCd')->nullable();
            $table->string('CrpnNm')->nullable()->index();
            $table->string('CorpActnStartDt')->nullable();
            $table->string('CtdyTrtmntTpNm')->nullable();
            $table->string('MktCptlstn')->nullable();
            $table->string('CorpGovnLvlNm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivo_conteudos');
    }
};
