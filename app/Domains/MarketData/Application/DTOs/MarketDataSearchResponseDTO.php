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

    public static function fromModel(object|array $marketData): self
    {
        $rptDt = is_array($marketData) ? $marketData['rpt_dt'] : $marketData->rpt_dt;
        $tckrSymb = is_array($marketData) ? $marketData['tckr_symb'] : $marketData->tckr_symb;
        $mktNm = is_array($marketData) ? $marketData['mkt_nm'] : $marketData->mkt_nm;
        $sctyCtgyNm = is_array($marketData) ? $marketData['scty_ctgy_nm'] : $marketData->scty_ctgy_nm;
        $isin = is_array($marketData) ? $marketData['isin'] : $marketData->isin;
        $crpnNm = is_array($marketData) ? $marketData['crpn_nm'] : $marketData->crpn_nm;

        return new self(
            rptDt: Carbon::parse($rptDt)->toDateString(),
            tckrSymb: $tckrSymb,
            mktNm: $mktNm,
            sctyCtgyNm: $sctyCtgyNm,
            isin: $isin,
            crpnNm: $crpnNm,
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
