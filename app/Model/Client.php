<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'cpf', 'phone', 'address'];

    /**
     * Relationship one to many with purchase.
     */
    public function purchases()
    {
        return $this->hasMany('App\Model\Purchase');
    }
}
