<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ConversionHistory extends Model
{
    use HasFactory;

    protected $table = 'conversion_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
    */
    protected $fillable = [
        'origin',
        'destiny',
        'user_id',
        'value',
        'payment_method_id',
        'destiny_currency_value',
        'purchased_value',
        'payment_tax',
        'conversion_tax'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
