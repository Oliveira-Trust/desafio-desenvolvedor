<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DataTables;

class CurrencyConversion extends Model
{
    use HasFactory;
    
    protected   $table          = 'con_reg_conversions';
    protected   $dateFormat     = 'd/m/Y H:i:s';
    protected   $primaryKey     = 'id';

    protected $fillable = [
        'origin_currency',
        'cur_id',
        'origin_value',
        'payment_method',
        'tax_currency',
        'tax_payment_method',
        'tax_conversion',
        'converted_value',
        'updated_value',
        'usu_id',
    ];

protected $dates = ['created_at']; 

    const   PAYMENT_METHOD = [
        'CREDIT_CARD' => 'Cartão de Crédito',
        'BANK_SLIP' => 'Boleto'
    ];


    public function User()
    {
        return $this->belongsTo('App\Models\User', 'usu_id');
    }

    public function Currency()
    {
        return $this->belongsTo('App\Models\Currency', 'cur_id');
    }





    public function getPaymentMethodAttribute($Value)
    {
        return  $this::PAYMENT_METHOD[$Value];
    }

    public function getOriginValueAttribute($Value)
    {
       return number_format($Value, 2, ',', '.');
    }

    public function getTaxCurrencyAttribute($Value)
    {
       return number_format($Value, 2, ',', '.');
    }

    public function getTaxPaymentMethodAttribute($Value)
    {
       return number_format($Value, 2, ',', '.');
    }

    public function getTaxConversionAttribute($Value)
    {
       return number_format($Value, 2, ',', '.');
    }

    public function getConvertedValueAttribute($Value)
    {
       return number_format($Value, 2, ',', '.');
    }

    public function getUpdatedValueAttribute($Value)
    {
       return number_format($Value, 2, ',', '.');
    }


    static function  CurrencyList() {
        return \App\Models\Currency::pluck('abbreviation', 'id')->all();        
    }


    static function Datatable()
    {
      $Datatable =  CurrencyConversion::select('id', 'cur_id', 'origin_value', 'tax_currency',  'payment_method', 'converted_value', 'usu_id', 'created_at')
      ->with(['Currency:id,abbreviation', 'User:id,name']);

        // Se o usuário não tem a permisao ele nao pode visualizar dos outros usuarios
        
        $User = \Auth::user();
        if(!$User->hasRole('Currency Conversion All User'))
        {
            $Datatable->where('usu_id', $User->id);
        }

        return $Datatable;

    }

  
}