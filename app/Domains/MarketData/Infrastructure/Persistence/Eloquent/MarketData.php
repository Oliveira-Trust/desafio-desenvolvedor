<?php

namespace App\Domains\MarketData\Infrastructure\Persistence\Eloquent;

use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'upload_id',
    'rpt_dt',
    'tckr_symb',
    'mkt_nm',
    'scty_ctgy_nm',
    'isin',
    'crpn_nm',
])]
class MarketData extends Model
{
    use HasFactory;

    protected $table = 'market_data';

    protected function casts(): array
    {
        return [
            'upload_id' => 'integer',
            'rpt_dt' => 'date',
        ];
    }

    public function upload(): BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }
}