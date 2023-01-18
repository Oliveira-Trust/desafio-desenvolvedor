<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoinAsk
 *
 * @property $id
 * @property $coin_dest
 * @property $coin_base
 * @property $value_of
 * @property $payment_method
 * @property $ranting_ask
 * @property $tax_convert
 * @property $tax_payment
 * @property $total_used
 * @property $total_dest
 * @property $user_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CoinAsk extends Model
{
    
    static $rules = [
		'coin_dest' => 'required',
		'coin_base' => 'required',
		'value_of' => 'required',
		'payment_method' => 'required',
		'ranting_ask' => 'required',
		'tax_convert' => 'required',
		'tax_payment' => 'required',
		'total_used' => 'required',
		'total_dest' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['coin_dest','coin_base','value_of','payment_method','ranting_ask','tax_convert','tax_payment','total_used','total_dest','user_id'];



}
