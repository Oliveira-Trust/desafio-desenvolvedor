<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_id',
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}