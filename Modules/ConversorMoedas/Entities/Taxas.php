<?php

namespace Modules\ConversorMoedas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxas extends Model
{
    use HasFactory;

    protected $table = 'taxas';
    public $timestamps = true;
    protected $fillable = ['id','tipo','created_at','updated_at','ativo','valor'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\ConversorMoedas\Database\factories\TaxasFactory::new();
    // }
}
