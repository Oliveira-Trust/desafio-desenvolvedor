<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyExchangeSettingsRequest;
use App\Services\CurrencyExchangeSettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CurrencyExchangeSettingsController extends Controller
{
    public function __construct(private readonly CurrencyExchangeSettingsService $currencyExchangeSettingsService)
    {
    }

    public function show(): View
    {
        $settings = $this->currencyExchangeSettingsService->getSettings();

        return view('panel.exchange.settings', compact('settings'));
    }

    public function save(CurrencyExchangeSettingsRequest $request): RedirectResponse
    {
        $this->currencyExchangeSettingsService->saveSettings($request->validated());

        return redirect()->route('currencyExchangeSettings');
    }
}
