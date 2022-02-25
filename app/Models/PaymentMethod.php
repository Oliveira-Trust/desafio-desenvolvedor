<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'method',
        'fee',
    ];

    protected $appends = [
        'method_name',
    ];

    public function getMethodNameAttribute()
    {
        $methods = [
            'credit_card' => 'Cartão de crédito',
            'billet' => 'Boleto',
        ];

        return $methods[$this->method];
    }
}
