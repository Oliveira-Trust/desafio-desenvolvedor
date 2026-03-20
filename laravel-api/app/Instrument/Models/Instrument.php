<?php

declare(strict_types=1);

namespace App\Instrument\Models;

use App\FileUpload\Models\FileUpload;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'email', 'password'])]
class Instrument extends Model
{
    protected $casts = [
        'RptDt' => 'date',
    ];

    public function fileUpload(): BelongsTo
    {
        return $this->belongsTo(FileUpload::class);
    }
}
