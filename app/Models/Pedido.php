<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)->withPivot(['quantidade', 'valor']);
    }

    public function pedidoProdutos()
    {
        return $this->hasMany(PedidoProduto::class);
    }

}
