<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Arquivo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tamanho'];

    public function conteudo(): HasMany
    {
        return $this->hasMany(ArquivoConteudo::class);
    }

    public function historico(): HasOne
    {
        return $this->hasOne(HistoricoArquivo::class);
    }
}
