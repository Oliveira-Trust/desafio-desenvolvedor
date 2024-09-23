<?php
namespace App\Services\Documento;

use App\Models\Documento;
use MongoDB\Laravel\Eloquent\Model;

class ImportarDocumento  implements Model {

            public function model(array $row) 
            {
                  return new Documento([
                    'RptDt'                => $row[1],
                    'TckrSymb'         => $row[2],
                    'ISIN'                    => $row[3],
                    'SgmtNm'           => $row[4],
                    'MinPric'             => $row[5],
                    'MaxPric'            => $row[6],
                    'TradAvrgPric'  => $row[7],
                    'LastPric'            => $row[8],
                    'OscnPctg'         => $row[9],
                    'AdjstdQt'          => $row[10],
                    'AdjstdQtTax'   => $row[11],
                    'RefPric'             => $row[12],
                    'TradQty'           => $row[13],
                    'FinInstrmQty' => $row[14],
                    'NtlFinVol'        => $row[15],
                  ]);
            }

}