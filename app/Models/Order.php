<?php

namespace App\Models;

use App\Models\Traits\ByUser;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use ByUser;
}
