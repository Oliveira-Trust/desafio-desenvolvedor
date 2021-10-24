<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCotacaoTaxa extends Model
{
    use HasFactory;
    protected $table = "users_cotacoes_taxas";
    protected $fillable = [
        'cotacao_taxa_id',
        'user_cotacao_id'
    ];

}
