<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;
    protected $table = 'taxa_conversao';
    protected $fillable = [
        'id',
        'valor_limite',
        'taxa_abaixo',
        'taxa_acima',
        'created_at',
        'updated_at',
    ];
}
