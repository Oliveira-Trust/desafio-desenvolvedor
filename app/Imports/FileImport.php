<?php

namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;

class FileImport implements ToModel
{
    protected $uploadId;

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FileContent([
            'tckr_symb' => $row['TckrSymb'],
            'rpt_dt' => $row['RptDt'],
            'mkt_nm' => $row['MktNm'],
            'scty_ctgy_nm' => $row['SctyCtgyNm'],
            'isin' => $row['ISIN'],
            'crpn_nm' => $row['CrpnNm'],
            'upload_id' => $this->uploadId,
        ]);
    }
}
