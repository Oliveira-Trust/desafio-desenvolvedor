<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_abaixo', 'taxa_abaixo', 'valor_acima', 'taxa_acima'
    ];
}
