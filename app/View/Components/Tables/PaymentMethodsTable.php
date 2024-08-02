<?php

namespace App\View\Components\Tables;

use App\Models\PaymentMethod;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentMethodsTable extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.tables.payment-methods-table', [
            'paymentMethods' => PaymentMethod::all(),
        ]);
    }
}
