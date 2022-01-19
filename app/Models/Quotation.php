<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table =  'quotations';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'user_id',
                            'target_coin',
                            'source_coin',
                            'conversion_amount',
                            'payment_type',
                            'source_coin_value',
                            'buy_amount',
                            'rate_payment',
                            'conversion_rate',
                            'net_amount',
                        ];

    /**
     * Método que retona o relacionamento de 1 para 1  entre cotação e usuário
     */

     public function user()
     {
        return $this->hasOne(User::class, 'id', 'user_id');
     }
}
