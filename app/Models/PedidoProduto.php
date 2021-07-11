<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    use HasFactory;

    protected $fillable = ['valor', 'produto_id', 'pedido_id', 'quantidade'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    } 
}
