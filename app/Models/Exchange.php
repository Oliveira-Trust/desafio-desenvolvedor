<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    public function user()
    {
      return $this->belongsTo(\App\Models\User::class, 'user_id')->withTrashed();
    } 

    public function currency()
    {
      return $this->belongsTo(\App\Models\Currency::class, 'currency_id')->withTrashed();
    } 

    public function payment()
    {
      return $this->belongsTo(\App\Models\PaymentMethod::class, 'payment_methods_id')->withTrashed();
    }     

    public function getAskAmountAttribute(){  
        return $this->ask - $this->payment_tax - $this->conversion_tax;              
    }
    public function getAmountAttribute(){          
        $amount =  $this->ask_amount / $this->rate;
        return round($amount,2);
    }
}
