<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class FileContent extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    // Coleção para os conteúdos dos arquivos
    protected string $collection = 'file_contents';

    // Campos preenchíveis
    protected $fillable = [
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
    ];

    protected $casts = [
        'RptDt' => 'string',
        'TckrSymb' => 'string',
        'MktNm' => 'string',
        'SctyCtgyNm' => 'string',
        'ISIN' => 'string',
        'CrpnNm' => 'string',
    ];

    public function upload(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }
}
