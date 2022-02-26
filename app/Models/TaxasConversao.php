<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxasConversao extends Model
{
    use HasFactory;

    protected $table = "taxas_conversao";
    protected $fillable = [
        'valor',
        'tipo',
        'taxa'
    ];
}
