<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = ['descricao', 'quantidade', 'preco'];

    public function itensPedido() {
        return $this->hasMany('App\Models\ItemPedido');
    }    
}
