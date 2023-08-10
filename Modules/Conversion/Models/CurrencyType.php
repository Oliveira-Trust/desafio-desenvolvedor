<?php

namespace Modules\Conversion\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrencyType extends CachedModel {
    use SoftDeletes;

    protected $fillable = ['name', 'symbol', 'full_name'];
}
