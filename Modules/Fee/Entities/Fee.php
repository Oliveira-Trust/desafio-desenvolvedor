<?php

namespace Modules\Fee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'boleto',
        'credit_card',
        'less_than_3000',
        'more_than_3000'
    ];

    /**
     * Accessors
     */
    public function getFormattedBoletoAttribute()
    {
        return $this->boleto * 100;
    }

    public function getFormattedCreditCardAttribute()
    {
        return $this->credit_card * 100;
    }

    public function getFormattedLessThan3000Attribute()
    {
        return $this->less_than_3000 * 100;
    }

    public function getFormattedMoreThan3000Attribute()
    {
        return $this->more_than_3000 * 100;
    }

    /**
     * Mutators
     */
    public function setBoletoAttribute($value)
    {
        $this->attributes['boleto'] = $value / 100;
    }

    public function setCreditCardAttribute($value)
    {
        $this->attributes['credit_card'] = $value / 100;
    }

    public function setLessThan3000Attribute($value)
    {
        $this->attributes['less_than_3000'] = $value / 100;
    }

    public function setMoreThan3000Attribute($value)
    {
        $this->attributes['more_than_3000'] = $value / 100;
    }
}
