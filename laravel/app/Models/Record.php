<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Record extends Model
{
    protected $collection = 'records';
    protected $connection = 'mongodb';

    protected $fillable = [
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
    ];
}
