<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class InstrumentsConsolidatedUploadHistory extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected string $collection = 'instruments_consolidate_upload_history';

    protected $fillable = [
        'filename',
    ];

    protected $hidden = [
        '_id',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'filename' => 'string',
        ];
    }
}
