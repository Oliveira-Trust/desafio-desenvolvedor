<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $casts = [
      'created_at' => 'datetime',
    ];

    public function user()
    {
      return $this->belongsTo(\App\Models\User::class, 'user_id');
    } 

    public function currency()
    {
      return $this->belongsTo(\App\Models\Currency::class, 'currency_id');
    } 

    public function payment()
    {
      return $this->belongsTo(\App\Models\PaymentMethod::class, 'payment_method_id');
    }         

    public function getTotalExchangeTaxAttribute(){
      return ($this->exchange_tax/100) * $this->ask;
    }

    public function getTotalPaymentTaxAttribute(){
      return ($this->payment_tax/100) * $this->ask;
    }

    public function getAskAmountAttribute(){  
        return $this->ask - $this->total_payment_tax - $this->total_payment_tax;              
    }
    
    public function getAmountAttribute(){          
        $amount =  $this->ask_amount / $this->rate;
        return round($amount,2);
    }
}
