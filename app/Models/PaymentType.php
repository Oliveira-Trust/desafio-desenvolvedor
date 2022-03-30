<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class PaymentType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'fee',
        'status',
    ];

    public function currenciesPurchases()
    {
        $this->hasMany(CurrencyPurchase::class);
    }

    public function scopeSearch($query, $data = [])
    {
        $query->when(Arr::get($data, 'name'), function($query) use($data){
            $query->where('name', Arr::get($data, 'name'));
        });

        $query->when(Arr::get($data, 'status'), function($query) use($data){
            $query->where('status', Arr::get($data, 'status'));
        });

        $query->orderBy('name');
        return $query;
    }
}
