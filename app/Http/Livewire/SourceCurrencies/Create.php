<?php

namespace App\Http\Livewire\SourceCurrencies;

use App\Models\SourceCurrency;
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
        return SourceCurrency::class;
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
                ->placeholder('Ex.: BRL')
                ->required(),
            Components\TextInput::make('symbol')
                ->label('Símbolo')
                ->placeholder('Ex.: R$')
                ->required(),
            Components\TextInput::make('description')
                ->label('Descrição')
                ->placeholder('Ex.: Real Brasileiro')
                ->required(),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        SourceCurrency::create($this->form->getState());

        Notification::make()
            ->title('Moeda adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('source-currencies.index');
    }

    public function render(): View
    {
        return view('livewire.source-currencies.create');
    }
}
