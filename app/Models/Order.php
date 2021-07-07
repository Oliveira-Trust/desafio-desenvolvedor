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
    


    
    /* Mutators */
    public function setPaidAtAttribute($value){
        $this->attributes['paid_at'] = empty($value) ? '1900-01-01' : $value;
    } 


}
