<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = ['nome', 'sobrenome', 'email', 'senha'];

    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = \Hash::make($value);
    }

    public function pedidos() {
        return $this->hasMany('App\Models\Pedido');
    }
}
