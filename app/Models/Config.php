<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = ['id','user_id','taxa_conversao','taxa_pagamento_boleto','taxa_pagamento_cartao'];
    protected $table = 'config';

    protected $primaryKey = 'id';

    protected  $dates = [
        'created_at',
        'updated_at'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
