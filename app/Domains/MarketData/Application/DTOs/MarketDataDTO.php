<?php

namespace App\Domains\MarketData\Application\DTOs;

final class MarketDataDTO
{
    public function __construct(
        public int $uploadId,
        public string $rptDt,
        public string $tckrSymb,
        public string $mktNm,
        public string $sctyCtgyNm,
        public string $isin,
        public string $crpnNm,
    ) {}
}