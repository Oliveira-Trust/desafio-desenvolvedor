<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipo\TipoCobranca;

class UserCotacao extends Model
{
    use HasFactory;
    protected $table = "users_cotacoes";
    protected $fillable = [
        'user_id',
        'moeda_origem_id',
        'moeda_destino_id',
        'tipo_cobranca_id',
        'val_quantia',
        'val_bid'
    ];

    public function tipoCobranca(){
        return $this->belongsTo(TipoCobranca::class, 'tipo_cobranca_id', 'id');
    }
}
