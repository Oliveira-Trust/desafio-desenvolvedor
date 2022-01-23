<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    
    protected   $table          = 'con_reg_currencies';
    protected   $dateFormat     = 'd/m/Y H:i:s';
    protected   $primaryKey     = 'id';

    protected $fillable = [
        'abbreviation',
        'name',
    ];

    public function CurrencyConversion()
    {
        return $this->hasMany('App\Models\CurrencyConversion', 'cur_id');
    }
}