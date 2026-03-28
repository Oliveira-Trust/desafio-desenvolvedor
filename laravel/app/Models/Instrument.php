<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Instrument extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'instruments';

    protected $fillable = [
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
        'upload_id',
    ];
}
