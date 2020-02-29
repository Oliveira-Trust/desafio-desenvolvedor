<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produtos extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'valorVenda',
        'valorCompra',
    ];


    public function Pedidos(){
        // return $this->belongsToMany('App\Pedidos', null ,'idProduto','id');
        return $this->belongsToMany('App\Pedidos', null, 'idProduto');
    }
}
