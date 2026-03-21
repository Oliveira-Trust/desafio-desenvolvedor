<?php

namespace App\Domains\MarketData\Application\DTOs;

use Illuminate\Support\Carbon;

final class MarketDataSearchResponseDTO
{
    public function __construct(
        public string $rptDt,
        public string $tckrSymb,
        public string $mktNm,
        public string $sctyCtgyNm,
        public string $isin,
        public string $crpnNm,
    ) {}

    public static function fromModel(object $marketData): self
    {
        return new self(
            rptDt: Carbon::parse($marketData->rpt_dt)->toDateString(),
            tckrSymb: $marketData->tckr_symb,
            mktNm: $marketData->mkt_nm,
            sctyCtgyNm: $marketData->scty_ctgy_nm,
            isin: $marketData->isin,
            crpnNm: $marketData->crpn_nm,
        );
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'RptDt' => $this->rptDt,
            'TckrSymb' => $this->tckrSymb,
            'MktNm' => $this->mktNm,
            'SctyCtgyNm' => $this->sctyCtgyNm,
            'ISIN' => $this->isin,
            'CrpnNm' => $this->crpnNm,
        ];
    }
}
