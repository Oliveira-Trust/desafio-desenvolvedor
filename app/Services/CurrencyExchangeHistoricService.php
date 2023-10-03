<?php

namespace App\Services;

use App\Repositories\CurrencyExchangeHistoricRepository;
use Illuminate\Support\Collection;

class CurrencyExchangeHistoricService
{
    public function __construct(
        private readonly CurrencyExchangeHistoricRepository $currencyExchangeHistoricRepository
    ) {
    }

    public function getHistoric(): Collection
    {
        try {
            return $this->currencyExchangeHistoricRepository->with('user')->latest()->get();
        } catch (\Exception) {
            throw new \Exception('Falha ao recuperar histórico de cotação de moedas.');
        }
    }

    public function saveHistoric(\stdClass $currencyQuotation): void
    {
        try {
            $this->currencyExchangeHistoricRepository->create([
                'source_currency' => $currencyQuotation->code,
                'destination_currency' => $currencyQuotation->codein,
                'currency_bid' => $currencyQuotation->bid,
                'conversion_value' => $currencyQuotation->conversion_value,
                'payment_type' => $currencyQuotation->payment_type,
                'payment_tax' => $currencyQuotation->payment_tax,
                'conversion_tax' => $currencyQuotation->conversion_tax
            ]);
        } catch (\Exception $exception) {
            logger()->warning($exception->getMessage());
            request()->session()->flash('error', $exception->getMessage());
        }
    }
}
