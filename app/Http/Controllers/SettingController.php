<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Http\Requests\UpdateConversionRateRequest;
use App\Models\ConversionRate;
use App\Models\PaymentMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index(): View
    {
        return view('app.settings');
    }

    public function updateConversionRate(UpdateConversionRateRequest $request): RedirectResponse
    {
        ConversionRate::first()->update($request->validated());

        return redirect(route('settings'));
    }

    public function updatePaymentMethod(PaymentMethodRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $paymentMethod = PaymentMethod::find($data['id']);

        if (! isset($data['active'])) {
            $data['active'] = false;
        }

        $paymentMethod->update(collect($data)->except('id')->toArray());

        $this->forgetPaymentMethodsCaches($paymentMethod->label);

        return redirect(route('settings'));
    }

    public function createPaymentMethod(PaymentMethodRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (! isset($validated['active'])) {
            $validated['active'] = false;
        }

        $paymentMethod = PaymentMethod::create($validated);

        $this->forgetPaymentMethodsCaches($paymentMethod->label);

        return redirect(route('settings'));
    }

    private function forgetPaymentMethodsCaches(string $label): void
    {
        Cache::forget('paymentMethods');
        Cache::forget("paymentMethod::$label");
        Cache::forget("paymentMethodTitle::$label");
    }
}
