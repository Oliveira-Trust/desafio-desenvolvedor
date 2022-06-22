<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValueRangeRule implements Rule
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
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valueFormated = preg_replace('/[^0-9]/', '', $value) / 100;

        if ($valueFormated <= 1000 or $valueFormated >= 100000) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Valor informado deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00.';
    }
}
