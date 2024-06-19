<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;

    protected $table = 'taxas';

    protected $fillable = [
        'TAXA',
        'DESC_TAXA',
        'VALOR',
    ];

    public $timestamps = false;
}

