<?php

namespace App\Models;

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



    
	/**
     * relationships
     *
     * @return void
     */
	public function client() { return $this->belongsTo(Client::class, 'client_id', 'id'); }
    
}
