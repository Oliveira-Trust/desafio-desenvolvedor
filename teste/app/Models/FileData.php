<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileData extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'file_data';

    protected $fillable = [
        'file_id',
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
    ];

    public function file(): BelongsTo {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
