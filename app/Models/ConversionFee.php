<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ConversionFee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comparison_operator',
        'comparator_value',
        'fee',
        'status'
    ];

    public function currencyPurchases()
    {
        return $this->hasMany(CurrencyPurchaseConversionFee::class);
    }

    public function scopeSearch($query, array $data = [])
    {
        $query->when(Arr::get($data, 'status'), function($query) use($data){
            $query->where('status', Arr::get($data, 'status'));
        });


        $query->orderBy('id', 'desc');
        return $query;
    }

}
