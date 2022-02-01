<?php

namespace Domain\Fees\Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $fillable = ['payment_method_id', 'percentage'];
}
