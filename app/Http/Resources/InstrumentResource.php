<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'RptDt' => $this->RptDt,
            'TckrSymb' => $this->TckrSymb,
            'MktNm' => $this->MktNm,
            'SctyCtgyNm' => $this->SctyCtgyNm,
            'ISIN' => $this->ISIN,
            'CrpnNm' => $this->CrpnNm,
        ];
    }
}
