<?php

namespace App\Http\Livewire\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;

use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return PaymentMethod::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('title')
                ->label('Título')
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
        PaymentMethod::create($this->form->getState());

        Notification::make()
            ->title('Forma de pagamento adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('payment-methods.index');
    }

    public function render(): View
    {
        return view('livewire.payment-method.create');
    }
}
