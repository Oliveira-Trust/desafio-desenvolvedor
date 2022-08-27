<?php

namespace App\Http\Livewire\PaymentMethod;

use Livewire\Component;

use App\Models\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public PaymentMethod $paymentMethod;

    protected function getFormModel(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function mount($id): void
    {
        $this->paymentMethod = PaymentMethod::findOrFail($id);

        $this->form->fill([
            'title' => $this->paymentMethod->title,
            'fee' => $this->paymentMethod->fee,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('title')
                ->label('Título')
                ->unique('payment_methods', 'title', $this->paymentMethod)
                ->required(),
            Components\TextInput::make('fee')
                ->label('Taxa')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->suffix('%')
                ->required(),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
       $this->paymentMethod->fill($this->form->getState())->save();

        Notification::make()
            ->title('Forma de pagamento atualizada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('payment-method.index');
    }
    public function render(): View
    {
        return view('livewire.payment-method.edit');
    }
}