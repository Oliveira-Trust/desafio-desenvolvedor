<?php

namespace Converter\Models;

use Converter\Enums\PaymentTax;
use Converter\Enums\PaymentType;
use Converter\Scopes\UserPaymentsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Payment extends Model
{
    use HasFactory;

    protected $payment_tax;
    protected $convertion_tax;

    protected $fillable = [
        'value',
        'type',
        'currency',
        'currency_value'
    ];

    protected $casts = [
        'currency_value' => 'float'
    ];

    protected static function booted()
    {
        static::addGlobalScope(App::make(UserPaymentsScope::class));
    }

    public function getPaymentTaxValue(): float
    {
        return $this->value * ($this->getPaymentTax() / 100);
    }

    public function getPaymentTax(): float
    {
        return [
            PaymentType::BILLET => PaymentTax::BILLET,
            PaymentType::CREDIT_CARD => PaymentTax::CREDIT_CARD
        ][$this->type];
    }

    public function getConvertionTaxValue(): float
    {
        return $this->value * ($this->value < 3000 ?
            0.02 :
            0.01
        );
    }


    public function getTaxes(): array
    {
        return [
            'payment_tax' => $this->getPaymentTaxValue(),
            'convertion_tax' => $this->getConvertionTaxValue()
        ];
    }
}
