<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pedidos extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'idProduto',
        'idCliente',
        'quantidade',
        'valorTotal',
        'dataCompra',
        'status',
    ];

    public function Clientes(){
        return $this->hasOne('App\Clientes','id','idCliente');
    }

    public function Produtos(){
        return $this->hasOne('App\Produtos','id','idProduto');
    }
}
