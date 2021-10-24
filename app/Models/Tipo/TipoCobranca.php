<?php

namespace App\Models\Tipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCobranca extends Model
{
    use HasFactory;
    protected $table = "tipos_cobrancas";
    protected $fillable = [
        'nom_tipo_cobranca',
        'ind_status'
    ];

}
