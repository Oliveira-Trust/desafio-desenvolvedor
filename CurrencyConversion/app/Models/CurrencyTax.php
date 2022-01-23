<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyTax extends Model
{

    protected   $table          = 'con_reg_taxes';
    protected   $dateFormat     = 'd/m/Y H:i:s';
    protected   $primaryKey     = 'id';

    protected $fillable = [
        'less_value',
        'less_tax',
        'bigger_value',
        'bigger_tax',
        'tax_credit_card',
        'tax_bank_slip',
    ];

    public function getLessValueAttribute($Value)
    {
        return number_format($Value, 2, ',', '.');
    }

    public function getBiggerValueAttribute($Value)
    {
        return number_format($Value, 2, ',', '.');
    }    


}