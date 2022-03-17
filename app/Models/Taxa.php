<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentual',
        'valor_min',
        'valor_max',
    ];

    public function historico()
    {
        return $this->belongsTo(Historico::class);
    }
}
