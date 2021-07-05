<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LabelVerification implements Rule
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
        return preg_match('/^[A-Za-z0-9-]+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A URL só aceita letras, números e traços (-), não aceita espaços e caracteres especiais.';
    }
}
