<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPgto extends Model
{   
    protected $table = 'FormaPgto';
    protected $fillable = [
        'nome',
        'taxa',
        'status'
    ];

}
