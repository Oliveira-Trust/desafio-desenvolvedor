<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_max',
        'valor_min',
        'por_cento',        
    ];

    public function scopeConversao($query, $valor)
    {
        return $query->where([
            ['valor_max', '>=', $valor],
            ['valor_min', '<=', $valor],
        ])->get();;
    }
}
