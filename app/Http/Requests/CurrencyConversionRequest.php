<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Anik\Form\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyConversionRequest extends FormRequest
{
    /** @var string */
    private const USD = 'USD';

    /** @var string */
    private const EUR = 'EUR';

    /** @var string */
    private const BTC = 'BTC';

    /** @var string */
    private const BRL = 'BRL';

    /** @var string */
    private const TICKET = 'Boleto';

    /** @var string */
    private const CARD = 'Credito';

    /** @var string[] */
    private const TYPE_COINT = [
        self::USD,
        self::EUR,
        self::BTC
    ];

    /** @var string[] */
    private const TYPE_BASE = [
        self::BRL
    ];

    /** @var string[] */
    private const TYPE_FORM_PAGMENT = [
        self::TICKET,
        self::CARD
    ];
    protected function authorize(): bool
    {
        return true;
    }

    protected function rules(): array
    {
        return [
            'originCurrency'   => [
                'required',
                'string',
                Rule::in(
                    self::TYPE_BASE
                ),
            ],
            'destinyCurrency'   => [
                'required',
                'string',
                Rule::in(
                    self::TYPE_COINT
                ),
            ],
            'valueCurrency'     => 'string',
            'formPayment'       => [
                'required',
                'string',
                Rule::in(
                    self::TYPE_FORM_PAGMENT
                ),
            ],
        ];
    }
}
