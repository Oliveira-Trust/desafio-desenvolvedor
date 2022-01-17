<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxaConversao extends Model
{ 
    protected $fillable = [
        'a_partir',
        'taxa'
    ];
}
