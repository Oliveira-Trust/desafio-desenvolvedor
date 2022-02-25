<?php

namespace App\Rules;

use App\Helpers\FormatsTrait;
use Illuminate\Contracts\Validation\Rule;

class RangeCurrencyRule implements Rule
{
    use FormatsTrait;
    const VALUE_MINIMUM = 1000.00;
    const VALUE_MAXIMUM = 100000.00;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valueDecimal = $this->formatCurrencyBrlToDecimal($value);

        return $valueDecimal >= self::VALUE_MINIMUM && $valueDecimal <= self::VALUE_MAXIMUM;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Minimum ' . $this->formatCurrencyToBrl(self::VALUE_MINIMUM) . ' Maximum ' . $this->formatCurrencyToBrl(self::VALUE_MAXIMUM);
    }
}
