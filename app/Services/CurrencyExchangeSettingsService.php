<?php

namespace App\Services;

use App\Models\CurrencyExchangeSetting;
use App\Repositories\CurrencyExchangeSettingRepository;

class CurrencyExchangeSettingsService
{
    public function __construct(private readonly CurrencyExchangeSettingRepository $currencyExchangeSettingRepository)
    {}

    public function getSettings(): ?CurrencyExchangeSetting
    {
        return $this->currencyExchangeSettingRepository->first();
    }

    public function saveSettings(array $data): void
    {
        try {
            $currencyExchangeSetting = $this->currencyExchangeSettingRepository->first();

            if (! $currencyExchangeSetting) {
                $this->currencyExchangeSettingRepository->create($data);
            } else {
                $currencyExchangeSetting->update($data);
            }

            session()->flash('success', 'Configurações salvas com sucesso!');
        } catch (\Exception $exception) {
            logger()->warning($exception->getMessage());
            request()->session()->flash('error', $exception->getMessage());
        }
    }
}
