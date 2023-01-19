<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Config;

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

	public function __construct($data = null)
	{

		if(isset($data)){

			$data['coin_base'] = env('API_BASE_COIN');
			$data['tax_payment'] = self::payment_tax($data['payment_method'],$data['value_of']);
			$data['tax_convert'] = self::convert_tax($data['value_of']);
			$data['total_used'] = $data['value_of'] - $data['tax_convert'] - $data['tax_payment'];
			$data['total_dest'] = $data['total_used']  * $data['ranting_ask'];
			//dd($data);
			parent::__construct($data);	
		}
		
		
		

	}

	public static function payment_tax($payment_method,$value){
		 
		if($payment_method == 'boleto') return $value * Config::find('tax_payment.boleto');
		if($payment_method == 'card') return $value *  Config::find('tax_payment.card');
	}

	public static function convert_tax($value){
		 
		if($value <  Config::find('tax_convert.base')) return $value * Config::find('tax_convert.min');
		if($value >= Config::find('tax_convert.base')) return $value * Config::find('tax_convert.max');
	}
}
