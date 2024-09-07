<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    // Se o nome da tabela for diferente do nome da model pluralizada, defina-o aqui
    protected $table = 'uploads';

    // Defina os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

   
}
