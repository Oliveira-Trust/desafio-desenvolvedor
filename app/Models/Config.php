<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'taxa_conv_acima',
        'taxa_conv_abaixo',
        'taxa_boleto',
        'taxa_cartao',
    ];
}
