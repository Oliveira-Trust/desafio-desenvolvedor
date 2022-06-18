<?php

namespace Oliveiratrust\Models\Currency;

use Illuminate\Database\Eloquent\Model;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;

class Currency extends Model {

    protected $fillable = ['code', 'name', 'active'];

    public function prices()
    {
        return $this->hasMany(CurrencyPrice::class);
    }
}
