<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $sortable = ['id', 'descricao','valor', 'quantidade'];

    protected $fillable = ['descricao', 'valor', 'quantidade'];

}
