<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price'
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_product',  'product_id','purchase_id')->withPivot('amount');
    }
}
