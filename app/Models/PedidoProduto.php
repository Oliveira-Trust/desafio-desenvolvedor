<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    use HasFactory;

    public $table = 'pedido_produto';
    protected $fillable = ['valor', 'produto_id', 'pedido_id', 'quantidade'];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'id', 'produto_id');
    }
}
