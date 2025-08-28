<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportDataFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
