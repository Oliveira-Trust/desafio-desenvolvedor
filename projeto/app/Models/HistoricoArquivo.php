<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricoArquivo extends Model
{
    use HasFactory;

    protected $fillable = ['nome_arquivo'];

    public function arquivo(): BelongsTo
    {
        return $this->belongsTo(Arquivo::class);
    }
}
