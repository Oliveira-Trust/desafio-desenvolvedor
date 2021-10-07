<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moedas extends Model
{
    use SoftDeletes;
    /**
     * Atributos de Moedas editaveis
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'sigla'
    ];

    /**
     * Atributos Ocultos
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function taxas()
    {
        return $this->hasOne(Taxas::class, 'moeda_id', 'id');
    }
}
