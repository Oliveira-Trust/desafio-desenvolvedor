<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = [
        'id_client',
        'id_product',
        'quantity',
        'price_total'
    ];
    
    /**
     * Model Client
     * @return Client
     */
    public function client()
    {
        return Client::find($this->id_client);
    }
    
    /**
     * Model Client
     * @return Client
     */
    public function product()
    {
        return Product::find($this->id_product);
    }
}
