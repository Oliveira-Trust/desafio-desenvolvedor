<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxaConversao extends Model
{
    use HasFactory;

    protected $table = 'taxas_conversao';

    protected $casts = [
        'taxa' => 'float',
        'valorMin' => 'float',
        'valorMax' => 'float',
    ];
}
