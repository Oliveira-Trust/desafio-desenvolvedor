<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome_usuario',
        'email_usuario',
        'senha_usuario',
        'updated_at',
    ];
}
