<?php

namespace CurrencyConverter\Domain\Currency\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class QuotationHistory
 * @package App\Models
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class QuotationHistory extends Model
{
    protected $table = 'quotation_history';

    protected $fillable = [
        'destiny_currency',
        'value_for_conversion',
        'payment_method',
        'created_by'
    ];

    public $date = [
        'created_at'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function(self $model){

            $model->created_by = Auth::user()->id;
            $model->payment_method = $model->payment_method == 1 ? 'Boleto' : 'Cartão de Crédito';

        });
    }
}
