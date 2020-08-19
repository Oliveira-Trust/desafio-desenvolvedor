<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItenTransaction extends Model
{
    protected $table = 'iten_transactions';

    protected $fillable = ['id', 'quantity','transaction_id','product_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'id', 'product_id');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class,'id', 'transaction_id',);
    }

}
