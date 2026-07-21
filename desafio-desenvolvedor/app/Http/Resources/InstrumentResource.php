<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "RptDt" => $this->rpt_dt,
            "TckrSymb" => $this->tckr_symb,
            "MktNm" => $this->mkt_nm,
            "SctyCtgyNm" => $this->scty_ctgy_nm,
            "ISIN" => $this->isin,
            "CrpnNm" => $this->crpn_nm,
        ];
    }
}
