<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moeda extends Model
{
    use HasFactory;

    public function historico()
    {
        return $this->belongsToMany(Historico::class, 'moeda_origem_id', 'moeda_destino_id');
    }
}
