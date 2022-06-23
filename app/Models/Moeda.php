<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Moeda extends Model
{
    use HasFactory;

    protected $table = 'moedas';
    protected $fillable = [
        'id',
        'nome_moeda',
        'abreviacao_moeda',
        'created_at',
        'updated_at',
    ];
}
