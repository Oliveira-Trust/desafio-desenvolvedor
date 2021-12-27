<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = ['id','user_id','moeda_origem','moeda_destino','valor_conversao_original','forma_pagamento','valor_moeda','valor_comprado','valor_taxa_pagamento','valor_taxa_conversao','valor_conversao_com_taxa'];
    protected $table = 'historicos';

    protected $primaryKey = 'id';

    protected  $dates = [
        'created_at',
        'updated_at'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

}
