<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_product', 'purchase_id', 'product_id')->withPivot('amount');
    }

    public function totalValue(){
        $value = 0;
        foreach ($this->products as $product){
            $value += $product->pivot->amount * $product->price;
        }
        return $value;
    }

    public function totalAmount()
    {
        $amount = 0;
        foreach ($this->products as $product){
            $amount += $product->pivot->amount;
        }
        return $amount;
    }
}
