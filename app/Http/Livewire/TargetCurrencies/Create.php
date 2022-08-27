<?php

namespace App\Http\Livewire\TargetCurrencies;

use App\Models\TargetCurrency;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return TargetCurrency::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('acronym')
                ->label('Sigla')
                ->unique()
                ->maxLength(3)
                ->placeholder('Ex.: USD')
                ->required(),
            Components\TextInput::make('symbol')
                ->label('Símbolo')
                ->placeholder('Ex.: $')
                ->required(),
            Components\TextInput::make('description')
                ->label('Descrição')
                ->placeholder('Ex.: Dólar Americano')
                ->required(),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        TargetCurrency::create($this->form->getState());

        Notification::make()
            ->title('Moeda adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('target-currencies.index');
    }

    public function render(): View
    {
        return view('livewire.target-currencies.create');
    }
}
