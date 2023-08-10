<?php

namespace Modules\Conversion\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends CachedModel {

    use SoftDeletes;

    protected $fillable = ['name','tax'];
}
