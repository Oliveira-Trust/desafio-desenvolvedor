<?php

namespace App\Models;

use App\Models\ItensPedidosCompra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidosCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cliente_id',
        'valor_total',
        'status'
    ];


    public function itensPedidosCompra(): HasMany
    {
        return $this->hasMany(ItensPedidosCompra::class, 'pedido_compra_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }


}
