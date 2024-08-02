<?php

namespace App\View\Components\Cards\PaymentMethod;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentMethodsCard extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.cards.payment-method.payment-methods-card');
    }
}
