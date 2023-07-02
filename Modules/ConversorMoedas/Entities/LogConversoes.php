<?php

namespace Modules\ConversorMoedas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogConversoes extends Model
{
    use HasFactory;

    protected $table = 'log_conversoes_moeda';

    protected $fillable = ['id','payload','user_id','created_at','updated_at'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\ConversorMoedas\Database\factories\LogConversoesFactory::new();
    // }
}
