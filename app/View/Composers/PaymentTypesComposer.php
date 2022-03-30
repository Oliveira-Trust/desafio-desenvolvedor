<?php

namespace App\View\Composers;

use App\Models\PaymentType;
use App\Services\CurrencyService;
use App\Services\PaymentTypeService;
use Illuminate\View\View;

class PaymentTypesComposer
{
    public function __construct(
        private PaymentTypeService $paymentTypeService)
    {}

    public function compose(View $view)
    {
        $view->with('paymentTypes', $this->paymentTypeService->getPaymentTypes(['status' => true]));
    }
}
