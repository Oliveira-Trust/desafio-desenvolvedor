<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pedido extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pedidos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pedido_ident', 'pedido_data', 'cliente_id', 'produto_id', 'condicoes_id'];


    /*
    *   ADICIONADO AS RELACOES NO CONTROLE PARA REFERENCIA
    */
    public function pedidos_cliente(){

        return $this->hasOne('App\clientes','cliente_id', 'id');

    }

    public function pedidos_produto(){

        return $this->hasOne('App\produto','produto_id', 'id');

    }

    public function pedidos_condicoes(){

        return $this->hasOne('App\condicoes','condicoes_id', 'id');

    }
}
