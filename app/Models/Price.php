<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prices';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['currency_from','currency_to','total','payment_method','weight_from','weight_to','payment_rate','conversion_rate','buy_to_rate','total_rate'];

    public function getPaymentMethodAttribute($value)
    {
        return ($value == 'ticket') ? 'Boleto' : 'Cartão';
    }
    
    public function getTotalAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function getPaymentRateAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function getConversionRateAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function getBuyToRateAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function getTotalRateAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format("d/m H:i");
    }
    

}
