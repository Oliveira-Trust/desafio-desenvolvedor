<?php

namespace App\Http\Livewire\Currencies;

use App\Models\Currency;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Currency $currency;

    protected function getFormModel(): Currency
    {
        return $this->currency;
    }

    public function mount($id): void
    {
        $this->currency = Currency::findOrFail($id);

        $this->form->fill([
            'acronym' => $this->currency->acronym,
            'symbol' => $this->currency->symbol,
            'description' => $this->currency->description,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('acronym')
                ->label('Sigla')
                ->unique('currencies', 'acronym', $this->currency)
                ->maxLength(3)
                ->placeholder('Ex.: BRL')
                ->required(),
            Components\TextInput::make('symbol')
                ->label('Símbolo')
                ->unique('currencies', 'symbol', $this->currency)
                ->maxLength(3)
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
       $this->currency->fill($this->form->getState())->save;

        Notification::make()
            ->title('Moeda adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('currencies.index');
    }
    public function render(): View
    {
        return view('livewire.currencies.edit');
    }
}
