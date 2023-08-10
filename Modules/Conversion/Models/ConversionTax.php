<?php

namespace Modules\Conversion\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversionTax extends CachedModel {

    use SoftDeletes;

    protected $fillable = ['value', 'min', 'max'];

    public function scopeSearch($query, int $value): void {
        $query->where(function ($q) use ($value) {
            $q->whereNull('min');
            $q->orWhere('min', '<=', $value);
        });
        $query->where(function ($q) use ($value) {
            $q->whereNull('max');
            $q->orWhere('max', '>=', $value);
        });
    }
}
