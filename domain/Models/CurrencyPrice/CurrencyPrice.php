<?php

namespace Oliveiratrust\Models\CurrencyPrice;

use Illuminate\Database\Eloquent\Model;
use Oliveiratrust\Models\Currency\Currency;
use Oliveiratrust\Models\User\User;

class CurrencyPrice extends Model {

    protected $fillable = ['currency_id', 'price', 'user_id'];

}
