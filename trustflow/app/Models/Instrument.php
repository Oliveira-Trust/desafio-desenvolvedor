<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instrument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'upload_history_id',
        'RptDt',
        'TckrSymb',
        'Asst',
        'AsstDesc',
        'SgmtNm',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CFICd',
        'CrpnNm',
        'SpcfctnCd',
        'XprtnDt',
        'XprtnCd',
        'TradgStartDt',
        'TradgEndDt',
        'DlvryNtceStartDt',
        'DlvryNtceEndDt',
        'OpngPosLmtDt',
        'CorpActnStartDt',
        'BaseCd',
        'ConvsCritNm',
        'MtrtyDtTrgtPt',
        'ReqrdConvsInd',
        'OptnTp',
        'CtrctMltplr',
        'AsstQtnQty',
        'AllcnRndLot',
        'TradgCcy',
        'DlvryTpNm',
        'WdrwlDays',
        'WrkgDays',
        'ClnrDays',
        'RlvrBasePricNm',
        'OpngFutrPosDay',
        'SdTpCd1',
        'UndrlygTckrSymb1',
        'SdTpCd2',
        'UndrlygTckrSymb2',
        'PureGoldWght',
        'ExrcPric',
        'OptnStyle',
        'ValTpNm',
        'PrmUpfrntInd',
        'DstrbtnId',
        'PricFctr',
        'DaysToSttlm',
        'SrsTpNm',
        'PrtcnFlg',
        'AutomtcExrcInd',
        'CtdyTrtmntTpNm',
        'MktCptlstn',
        'CorpGovnLvlNm',
    ];


    protected $casts = [
        'RptDt' => 'string',
        'XprtnDt' => 'date',
        'TradgStartDt' => 'date',
        'TradgEndDt' => 'date',
        'DlvryNtceStartDt' => 'date',
        'DlvryNtceEndDt' => 'date',
        'OpngPosLmtDt' => 'date',
        'CorpActnStartDt' => 'date',
        'ReqrdConvsInd' => 'string',
        'PrmUpfrntInd' => 'string',
        'PrtcnFlg' => 'string',
        'AutomtcExrcInd' => 'string',
        'ExrcPric' => 'decimal:8',
        'CtrctMltplr' => 'decimal:8',
    ];


    public function uploadHistory(): BelongsTo
    {
        return $this->belongsTo(UploadHistory::class);
    }
}