<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ConversionHistory extends Model
{

    protected $table = 'conversions_history';

    protected $fillable = [
        'user_id',
        'origin_currency',
        'destination_currency',
        'value_conversation',
        'form_payment',
        'dest_currency_conv',
        'purchased_amount_in',
        'pay_rate',
        'conversion_rate',
        'amount_used_conv',
    ];


    protected $logAttributes = [
        'user_id',
        'origin_currency',
        'destination_currency',
        'value_conversation',
        'form_payment',
        'dest_currency_conv',
        'purchased_amount_in',
        'pay_rate',
        'conversion_rate',
        'amount_used_conv',
    ];


    protected $hidden = [];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
    }
}
