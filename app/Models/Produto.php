<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'estoque',
        'preco'
    ];

    public function itensPedidosCompras(): HasMany
    {
        return $this->hasMany(ItensPedidosCompra::class, 'produto_id', 'id');
    }


}
