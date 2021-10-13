<?php

declare(strict_types=1);

namespace App\Rules;

use App\Services\QuotationService;
use Illuminate\Contracts\Validation\Rule;

class RangeNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value) : bool
    {
        return QuotationService::rangeNumber($value, request('amount'));
    }

    /**
     * Get the validation error message.
     */
    public function message() : string
    {
        return 'O valor deve estar entre R$ 1.000,00 e 100.000,00';
    }
}
