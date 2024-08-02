<?php

namespace App\View\Components\Cards;

use App\Models\ConversionRate;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateConversionRateFormCard extends Component
{
    public function render(): View
    {
        return view('components.cards.update-conversion-rate-form-card', [
            'conversionRate' => ConversionRate::first(),
        ]);
    }
}
