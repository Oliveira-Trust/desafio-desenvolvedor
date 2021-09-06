<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItensPedidosCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_compra_id',
        'produto_id',
        'quantidade',
        'preco'
    ];
    

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function pedidoCompra(): BelongsTo
    {
        return $this->belongsTo(PedidosCompra::class);
    }

}
