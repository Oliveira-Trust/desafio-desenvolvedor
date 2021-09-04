<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ModelCadastro extends Model
{
    Protected $table = 'cadastros';
    protected $fillable=['produto', 'preço', 'id_user','nome'];

    public function relUsers()
    {
        return $this->hasOne('App\User','id','id_user');//Relacionamento 1 * 1 Um produto pode ter apenas 1 usuario
    }


}
