<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name', 'email', 'document', 'birth'
    ];

    /**
    * Order Relationship 
    */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
