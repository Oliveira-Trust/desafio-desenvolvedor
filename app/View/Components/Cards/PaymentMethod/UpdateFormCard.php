<?php

namespace App\View\Components\Cards\PaymentMethod;

use App\Models\PaymentMethod;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateFormCard extends Component
{
    public function __construct(
        public int $id
    ) {}

    public function render(): View
    {
        return view('components.cards.payment-method.update-form-card', [
            'paymentMethod' => PaymentMethod::find($this->id),
        ]);
    }
}
