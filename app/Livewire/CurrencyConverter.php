<?php

namespace App\Livewire;

use App\Services\AwesomeApiService;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CurrencyConverter extends Component
{
    public string $destinationCurrency = 'USD';
    public float $amount = 5000;
    public string $paymentMethod = 'boleto';
    public array $result = [];

    public array $callback_errors = [];

    public function rules(): array
    {
        return [
            'destinationCurrency' => 'required|in:USD,EUR',
            'amount' => 'required|numeric|min:1000|max:100000',
            'paymentMethod' => 'required|in:boleto,cartao',
        ];
    }

    public function convert(AwesomeApiService $awesomeApiService): void
    {
        $this->validate();

        $exchangeRate = $awesomeApiService->getExchangeRate($this->destinationCurrency);

        if (isset($exchangeRate['error'])) {
            $this->callback_errors['exchangeRate'] = $exchangeRate['error'];
            return;
        }

        $rate = $exchangeRate[0]['ask'];

        /*
         *   Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
         *   Para pagamentos em boleto, taxa de 1,45%
         *   Para pagamentos em cartão de crédito, taxa de 7,63%
         */
        $taxPayment = $this->paymentMethod === 'boleto' ? 0.0145 : 0.0763;

        /*
         *   Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00
         *   e 1% para valores maiores que R$ 3.000,00, essa taxa deve ser aplicada apenas
         *   no valor da compra e não sobre o valor já com a taxa de forma de pagamento.
         */
        $taxConversion = $this->amount < 3000 ? 0.02 : 0.01;

        $taxPaymentAmount = $this->amount * $taxPayment;

        $taxConversionAmount = $this->amount * $taxConversion;

        $amountAfterTaxes = $this->amount - $taxPaymentAmount - $taxConversionAmount;

        $convertedAmount = $amountAfterTaxes * $rate;

        $this->result = [
            'source_currency' => 'BRL',
            'destination_currency' => $this->destinationCurrency,
            'amount' => $this->amount,
            'payment_method' => $this->paymentMethod,
            'rate' => $rate,
            'converted_amount' => $convertedAmount,
            'tax_payment' => $taxPaymentAmount,
            'tax_conversion' => $taxConversionAmount,
            'amount_after_taxes' => $amountAfterTaxes,
        ];

        if (auth()->user()) {
            \App\Models\CurrencyHistoric::create([
                'user_id' => auth()->id(),
                'source_currency' => 'BRL',
                'destination_currency' => $this->destinationCurrency,
                'amount' => $this->amount,
                'payment_method' => $this->paymentMethod,
                'rate' => $rate,
                'converted_amount' => $convertedAmount,
                'tax_payment' => $taxPaymentAmount,
                'tax_conversion' => $taxConversionAmount,
                'amount_after_taxes' => $amountAfterTaxes,
            ]);

            $this->dispatch('currency-created');
        }
    }

    public function render(): View
    {
        return view('livewire.currency-converter');
    }
}
