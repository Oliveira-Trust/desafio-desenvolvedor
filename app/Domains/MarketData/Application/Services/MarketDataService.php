<?php

namespace App\Domains\MarketData\Application\Services;

final class MarketDataService
{
    public function marketDataList(): array
    {
        return
            [
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "AAPL34",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "BDR",
                    "ISIN" => "BRAAPLBDR018",
                    "CrpnNm" => "APPLE INC."
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "MSFT34",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "BDR",
                    "ISIN" => "BRAMSFTBDR026",
                    "CrpnNm" => "MICROSOFT CORPORATION"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "PETR4",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "ACAO",
                    "ISIN" => "BRPETRACNPR6",
                    "CrpnNm" => "PETROBRAS PN"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "VALE3",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "ACAO",
                    "ISIN" => "BRVALEACNOR6",
                    "CrpnNm" => "VALE ON"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "GOOGL34",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "BDR",
                    "ISIN" => "BRAGOOGBDR034",
                    "CrpnNm" => "ALPHABET INC."
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "ITUB4",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "ACAO",
                    "ISIN" => "BRITUBACNOR4",
                    "CrpnNm" => "ITAUBANCO ITAU HOLDING FINANCEIRA PN"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "BBDC4",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "ACAO",
                    "ISIN" => "BRBBDCACNOR5",
                    "CrpnNm" => "BANCO BRADESCO PN N1"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "NVDA34",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "BDR",
                    "ISIN" => "BRANVDABDR042",
                    "CrpnNm" => "NVIDIA CORPORATION"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "WEGE3",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "ACAO",
                    "ISIN" => "BRWEGEACNOR5",
                    "CrpnNm" => "WEG ON"
                ],
                [
                    "RptDt" => "2024-08-22",
                    "TckrSymb" => "MGLU3",
                    "MktNm" => "EQUITY-CASH",
                    "SctyCtgyNm" => "ACAO",
                    "ISIN" => "BRMGLUACNOR8",
                    "CrpnNm" => "MAGAZINE LUIZA ON"
                ]
            ];
    }
}
