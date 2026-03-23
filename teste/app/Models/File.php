<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'files';

    protected $fillable = [
        'original_name', 'path', 'hash_name', 'extension', 'size', 'user_id', 'status'
    ];

    protected function casts(): array {
        return [
            'created_at' => 'datetime:d-m-Y',
            'updated_at' => 'datetime:d-m-Y',
        ];
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fileData(): HasMany{
        return $this->hasMany(FileData::class, 'file_id', 'id');
    }
}
