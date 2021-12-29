<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotacoes extends Model
{
    protected $fillable = [
        'user_id', 'cotacao',
    ];
}
