<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_id',
        'RptDt',
        'TckrSymb',
        'Asst',
        'AsstDesc',
        'SgmtNm',
        'MktNm',
        'SctyCtgyNm',
        'XprtnDt',
        'XprtnCd',
        'TradgStartDt',
        'TradgEndDt',
        'BaseCd',
        'ConvsCritNm',
        'MtrtyDtTrgtPt',
        'ReqrdConvsInd',
        'ISIN',
        'CFICd',
        'DlvryNtceStartDt',
        'DlvryNtceEndDt',
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
        'OpngPosLmtDt',
        'DstrbtnId',
        'PricFctr',
        'DaysToSttlm',
        'SrsTpNm',
        'PrtcnFlg',
        'AutomtcExrcInd',
        'SpcfctnCd',
        'CrpnNm',
        'CorpActnStartDt',
        'CtdyTrtmntTpNm',
        'MktCptlstn',
        'CorpGovnLvlNm',
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
