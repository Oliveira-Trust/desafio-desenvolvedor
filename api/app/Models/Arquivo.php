<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\DocumentModel;

class Arquivo extends Model
{
    use DocumentModel, HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'arquivos';

    protected $fillable = [
        'nome',
        'diretorio',
        'status',
        'hash',
        'url'
    ];

    protected $casts = [
        'data' => 'datetime', // Se você estiver usando um tipo de data
    ];
}
