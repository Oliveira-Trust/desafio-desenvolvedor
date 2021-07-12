<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'produto_id', 'valor', 'quantidade'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function pedido()
    {
        return $this->hasMany(Pedido::class);
    }

}
