<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeeRuleUpdateRequest;
use App\Models\FeeRule;
use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingsController extends Controller
{
    private PaymentMethod $paymentMethods;
    private FeeRule $feeRules;

    public function __construct()
    {
        $this->paymentMethods = new PaymentMethod();
        $this->feeRules = new FeeRule();
    }

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $feeRules  = $this->feeRules->get()->map(function ($feeRule) {
            $feeRule->label = "Taxa para valores " . $feeRule->rule->value . " que o Valor Base";
            return $feeRule;
        });

        return view('settings.edit', [
            'paymentMethods' =>  $this->paymentMethods->get(),
            'feeRules' => $feeRules,
        ]);
    }
}
