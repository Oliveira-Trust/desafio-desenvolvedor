<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\DocumentModel;

class Documento extends Model
{
    use DocumentModel, HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'documentos';
    protected $keyType = 'string';
    protected $primaryKey = '_id';

    protected $fillable = [
        "RptDt",
        "TckrSymb" ,
        "ISIN" ,
        "SgmtNm" ,
        "MinPric" ,
        "MaxPric" ,
        "TradAvrgPric" ,
        "LastPric" ,
        "OscnPctg" ,
        "AdjstdQt" ,
        "AdjstdQtTax" ,
        "RefPric" ,
        "TradQty" ,
        "FinInstrmQty" ,
        "NtlFinVol" ,
    ];

    protected $casts = [
        'RptDt' => 'datetime', // Se você estiver usando um tipo de data
    ];

}
