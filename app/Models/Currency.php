<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Currency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'symbol',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function scopeSearch($query, $data = [])
    {
        $query->when(Arr::get($data, 'name'), function($query) use($data){
            $query->where('name', Arr::get($data, 'name'));
        });

        $query->orderBy('symbol');
        return $query;
    }
}
