<?php

namespace App\Models;

use Carbon\Carbon;

class Order extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'total',
        'status',
        'paid_at',
    ];

    protected $dates = ['paid_at'];

    
	/**
     * relationships
     *
     * @return void
     */
	public function client() { return $this->belongsTo(Client::class, 'client_id', 'id'); }
    public function orderproduct() { return $this->hasMany(OrderProduct::class , 'order_id', 'id'); }
    //public function product() { return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');  }


    
    /* Mutators */
    public function setPaidAtAttribute($value){
        $this->attributes['paid_at'] = empty($value) ? '1900-01-01' : $value;
    } 


}
