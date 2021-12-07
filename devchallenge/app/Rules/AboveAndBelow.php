<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Tax;

class AboveAndBelow implements Rule
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
        if(request()->input('application') == 'above'){
            $tax = Tax::getApplication('below');
            if($value > $tax->percent ){
                return true;
            }
        }

        if(request()->input('application') == 'below'){
            $tax = Tax::getApplication('above');
            if($value < $tax->percent ){
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the above percent value cannot be less than below percent value, and vice versa';
    }
}
