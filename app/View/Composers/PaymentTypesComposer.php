<?php

namespace App\View\Composers;

use App\Models\PaymentType;
use Illuminate\View\View;

class PaymentTypesComposer
{
    public function compose(View $view)
    {
        $view->with('paymentTypes', PaymentType::query()->get());
    }
}
