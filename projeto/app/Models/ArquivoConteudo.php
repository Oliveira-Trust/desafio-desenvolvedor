<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArquivoConteudo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'RptDt',
        'TckrSymb',
        'Asst',
        'AsstDesc',
        'SgmtNm',
        'MktNm',
        'SctyCtgyNm',
        'XprtnDt',
        'XprtnCd',
        'TradgStartDt',
        'TradgEndDt',
        'ISIN',
        'CFICd',
        'DlvryNtceStartDt',
        'OptnTp',
        'CtrctMltplr',
        'AsstQtnQty',
        'TradgCcy',
        'CorpActnStartDt',
        'MktCptlstn',
        'CrpnNm',
    ];

    public function arquivo(): BelongsTo
    {
        return $this->belongsTo(Arquivo::class);
    }
}
