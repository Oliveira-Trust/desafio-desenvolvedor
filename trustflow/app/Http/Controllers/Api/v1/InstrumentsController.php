<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * @group Instruments
 * 
 * Group for handling the registered instruments.
 */
class InstrumentsController extends Controller
{

    /**
     * List Instruments
     * 
     * Returns a paginated list of instruments registered in the system.
     * The data is cached for 60 minutes to optimize performance on repetitive queries.
     * 
     * @authenticated
     * 
     * @queryParam TckrSymb string optional Filter by ticker symbol (partial match). Example: PETR4
     * @queryParam RptDt date optional Filter by reference date (YYYY-MM-DD). Example: 2026-03-25
     * @queryParam format string optional Response format: "summary" (default) or "full". Example: summary
     * @queryParam page int optional Page number for pagination. Example: 1
     * 
     * @response 200 {
     *   "current_page": 1,
     *   "data": [
     *     {
     *       "RptDt": "2026-03-25",
     *       "TckrSymb": "PETR4",
     *       "MktNm": "VISTA",
     *       "SctyCtgyNm": "AÇÃO",
     *       "ISIN": "BRPETRACNPR6",
     *       "CrpnNm": "PETROBRAS"
     *     }
     *   ],
     *   "first_page_url": "http://localhost/api/v1/instruments?page=1",
     *   "from": 1,
     *   "last_page": 2,
     *   "last_page_url": "http://localhost/api/v1/instruments?page=2",
     *   "links": [
     *     {
     *       "url": null,
     *       "label": "&laquo; Previous",
     *       "active": false
     *     },
     *     {
     *       "url": "http://localhost/api/v1/instruments?page=1",
     *       "label": "1",
     *       "active": true
     *     }
     *   ],
     *   "next_page_url": "http://localhost/api/v1/instruments?page=2",
     *   "path": "http://localhost/api/v1/instruments",
     *   "per_page": 10,
     *   "prev_page_url": null,
     *   "to": 10,
     *   "total": 20
     * }
     * 
     * @response 200 scenario="full format" {
     *   "current_page": 1,
     *   "data": [
     *     {
     *       "id": 1,
     *       "upload_history_id": 5,
     *       "RptDt": "2026-03-25",
     *       "TckrSymb": "PETR4",
     *       "Asst": "STOCK",
     *       "AsstDesc": "Petróleo Brasileiro S.A.",
     *       "SgmtNm": "BOVESPA",
     *       "MktNm": "VISTA",
     *       "SctyCtgyNm": "AÇÃO",
     *       "XprtnDt": null,
     *       "XprtnCd": null,
     *       "TradgStartDt": "2020-01-01",
     *       "TradgEndDt": null,
     *       "BaseCd": 1,
     *       "ConvsCritNm": null,
     *       "MtrtyDtTrgtPt": null,
     *       "ReqrdConvsInd": null,
     *       "ISIN": "BRPETRACNPR6",
     *       "CFICd": "ESVUFR",
     *       "DlvryNtceStartDt": null,
     *       "DlvryNtceEndDt": null,
     *       "OptnTp": null,
     *       "CtrctMltplr": null,
     *       "AsstQtnQty": null,
     *       "AllcnRndLot": null,
     *       "TradgCcy": "BRL",
     *       "DlvryTpNm": null,
     *       "WdrwlDays": null,
     *       "WrkgDays": null,
     *       "ClnrDays": null,
     *       "RlvrBasePricNm": null,
     *       "OpngFutrPosDay": null,
     *       "SdTpCd1": null,
     *       "UndrlygTckrSymb1": null,
     *       "SdTpCd2": null,
     *       "UndrlygTckrSymb2": null,
     *       "PureGoldWght": null,
     *       "ExrcPric": null,
     *       "OptnStyle": null,
     *       "ValTpNm": null,
     *       "PrmUpfrntInd": null,
     *       "OpngPosLmtDt": null,
     *       "DstrbtnId": null,
     *       "PricFctr": null,
     *       "DaysToSttlm": null,
     *       "SrsTpNm": null,
     *       "PrtcnFlg": null,
     *       "AutomtcExrcInd": null,
     *       "SpcfctnCd": null,
     *       "CrpnNm": "PETROBRAS",
     *       "CorpActnStartDt": null,
     *       "CtdyTrtmntTpNm": null,
     *       "MktCptlstn": 300000000000,
     *       "CorpGovnLvlNm": "N1",
     *       "created_at": "2026-03-25T10:00:00.000000Z",
     *       "updated_at": "2026-03-25T10:00:00.000000Z"
     *     }
     *   ],
     *   "first_page_url": "http://localhost/api/v1/instruments?page=1",
     *   "from": 1,
     *   "last_page": 2,
     *   "last_page_url": "http://localhost/api/v1/instruments?page=2",
     *   "links": [...],
     *   "next_page_url": "http://localhost/api/v1/instruments?page=2",
     *   "path": "http://localhost/api/v1/instruments",
     *   "per_page": 10,
     *   "prev_page_url": null,
     *   "to": 10,
     *   "total": 20
     * }
     * 
     * @response 422 {
     *   "message": "The RptDt field must match the format Y-m-d.",
     *   "errors": {
     *     "RptDt": ["The RptDt field must match the format Y-m-d."]
     *   }
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request)
    {
        $ticker = $request->query('TckrSymb');
        $referenceDate = $request->query('RptDt');
        $format = $request->query('format', 'summary');
        $page = $request->query('page', 1);

        if($referenceDate){
            $request->validate([
                "RptDt" => "required|date_format:Y-m-d"
            ]);
        }

        $cacheKey = "global_history_t:{$ticker}_d:{$referenceDate}_p:{$page}_f{$format}";

        return Cache::tags(['instruments_data'])->remember($cacheKey, 60, function() use($ticker, $referenceDate, $format){
            
            $query = Instrument::query()
                ->when($ticker, fn($q) => $q->where('TckrSymb', 'like', "%{$ticker}%"))
                ->when($referenceDate, fn($q) => $q->where('RptDt', $referenceDate))
                ->latest();

            if (strtolower($format) !== "full") {
                $query->select(["RptDt", "TckrSymb", "MktNm", "SctyCtgyNm", "ISIN", "CrpnNm"]);
            }

            return $query->paginate(10)->toArray();
        });
    }

}
