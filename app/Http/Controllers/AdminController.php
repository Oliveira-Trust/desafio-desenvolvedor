<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\TaxConversion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct(
        private readonly PaymentMethod $paymentMethod,
        public TaxConversion $taxConversion
    )
    {}
    public function index(): View|Factory|Application
    {
        $paymentMethods = $this->paymentMethod->all();

        $taxConversion = $this->taxConversion->findOrFail(TaxConversion::DEFAULT_TAX_CONVERSION_ID);

        return view('admindashboard')->with([
            'paymentMethods' => $paymentMethods,
            'taxConversion' => $taxConversion
        ]);
    }

    public function paymentTax(Request $request): RedirectResponse
    {
        Log::info('payment_tax_updated_by_user: ' , [Auth::user()->email]);

        $paymentMethod = $this->paymentMethod->findOrFail($request->paymentMethodId);
        $paymentMethod->update([
            'method_tax' => $request->tax
        ]);

        return redirect()->action([AdminController::class, 'index']);
    }

    public function conversionTax(Request $request): RedirectResponse
    {
        Log::info('conversion_tax_updated_by_user:', [Auth::user()->email]);

        $taxConversion = $this->taxConversion->findOrFail(TaxConversion::DEFAULT_TAX_CONVERSION_ID);
        $taxConversion->update([
           'reference_value' => floatval($request->reference_value),
            'down_value_tax' => floatval($request->down_value_tax),
            'up_value_tax' => floatval($request->up_value_tax)
        ]);

        return redirect()->action([AdminController::class, 'index']);
    }
}
