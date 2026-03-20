<?php

declare(strict_types=1);

namespace App\FileUpload\Models;

use App\Instrument\Models\Instrument;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['original_name',
    'stored_name',
    'hash',
    'status',
    'reference_date',
    'total_rows',
    'error_message', ])]
class FileUpload extends Model
{
    use HasFactory;

    protected $casts = [
        'reference_date' => 'date',
        'total_rows' => 'integer',
    ];

    public function instruments(): HasMany
    {
        return $this->hasMany(Instrument::class);
    }
}
