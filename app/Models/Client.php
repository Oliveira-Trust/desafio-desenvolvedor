<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name',   'email'];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
