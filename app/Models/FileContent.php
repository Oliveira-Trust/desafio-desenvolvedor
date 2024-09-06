<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'tckr_symb',
        'rpt_dt',
        'mkt_nm',
        'scty_ctgy_nm',
        'isin',
        'crpn_nm',
        'upload_id',
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
