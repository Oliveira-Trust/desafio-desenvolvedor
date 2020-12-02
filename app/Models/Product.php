<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'name', 'description', 'price', 'stock'];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->using(OrderProduct::class)
            ->withTimestamps()
            ->withPivot('id', 'amount', 'total_price');
    }

    public static function updateStockProduct($product_id, $newAmount, $lastAmount = null)
    {
        $updateProduct = Product::find($product_id);
        if(!is_null($lastAmount)){
            if($lastAmount > $newAmount){
                $amount = $lastAmount - $newAmount;
                $updateProduct->stock = $updateProduct->stock +  $amount;
            } else if($lastAmount < $newAmount){
                $amount = $newAmount - $lastAmount;
                $updateProduct->stock = $updateProduct->stock - $amount;
            }
        } else {
            $updateProduct->stock = $updateProduct->stock + $newAmount;
        }
        $updateProduct->save();
    }
}
