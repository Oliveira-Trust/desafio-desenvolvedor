<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class ConfigTax extends ModalComponent
{
    public string $paymentMethodTax1;
    public string $paymentMethodTax2;
    public string $taxConversion1;
    public string $taxConversion2;

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function save(): void
    {
        if ($user = Auth::user()) {
            $user->payment_method_tax = [$this->paymentMethodTax1, $this->paymentMethodTax2];
            $user->tax_conversion = [$this->taxConversion1, $this->taxConversion2];
            $user->save();
        }

        $this->dispatch('tax-updated',
            paymentMethodTax1: $this->paymentMethodTax1,
            paymentMethodTax2: $this->paymentMethodTax2,
            taxConversion1: $this->taxConversion1,
            taxConversion2: $this->taxConversion2
        );

        session()->flash('message', 'Taxas atualizadas com sucesso!');

        $this->closeModal();
    }

    public function mount()
    {
    }

    public function render(): View
    {
        return view('livewire.components.config-tax');
    }
}
