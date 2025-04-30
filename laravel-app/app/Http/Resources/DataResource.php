<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'RptDt' => $this['RptDt'] ?? null,
            'TckrSymb' => $this['TckrSymb'] ?? null,
            'MktNm' => $this['MktNm'] ?? null,
            'SctyCtgyNm' => $this['SctyCtgyNm'] ?? null,
            'ISIN' => $this['ISIN'] ?? null,
            'CrpnNm' => $this['CrpnNm'] ?? null,
        ];
    }
} 