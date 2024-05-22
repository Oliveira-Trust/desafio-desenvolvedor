<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Interface\Quote\QuoteServiceInterface;


class isDestination implements ValidationRule
{
    protected $quoteService;
    protected $origin;
    public function __construct($origin,QuoteServiceInterface $quoteService)
    {
        $this->quoteService = $quoteService;
        $this->origin = $origin;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $available = $this->quoteService->getAvailableCurrenciesNormal($this->origin) ?? [];
        $availableCurrencies = collect($available)->map(function ($item) {
            return explode('-', $item);
        })->pluck(1);

        if ($availableCurrencies->contains($value) === false) {
            $fail("The $attribute is not a valid destination currency");
        }
    }
}
