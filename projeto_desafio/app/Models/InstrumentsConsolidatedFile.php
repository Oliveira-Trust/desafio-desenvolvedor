<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class InstrumentsConsolidatedFile extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected string $collection = 'instruments_consolidate_file_content';

    protected $fillable = [
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
    ];

    protected $hidden = [
        '_id',
        'updated_at',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'RptDt' => 'string',
            'TckrSymb' => 'string',
            'MktNm' => 'string',
            'SctyCtgyNm' => 'string',
            'ISIN' => 'string',
            'CrpnNm' => 'string',
        ];
    }
}
