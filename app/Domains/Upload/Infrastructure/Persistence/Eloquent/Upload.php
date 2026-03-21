<?php

namespace App\Domains\Upload\Infrastructure\Persistence\Eloquent;

use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'filename',
    'path',
    'mime_type',
    'size',
    'file_md5',
    'status',
    'processed_at',
    'error_message',
])]
class Upload extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';

    protected $table = 'uploads';

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'processed_at' => 'datetime',
        ];
    }

    public function marketData(): HasMany
    {
        return $this->hasMany(MarketData::class);
    }
}