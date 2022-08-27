<?php

namespace App\Http\Livewire\SourceCurrencies;

use App\Models\SourceCurrency;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public SourceCurrency $sourceCurrency;

    protected function getFormModel(): SourceCurrency
    {
        return $this->sourceCurrency;
    }

    public function mount($id): void
    {
        $this->sourceCurrency = SourceCurrency::findOrFail($id);

        $this->form->fill([
            'acronym' => $this->sourceCurrency->acronym,
            'symbol' => $this->sourceCurrency->symbol,
            'description' => $this->sourceCurrency->description,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('acronym')
                ->label('Sigla')
                ->unique('currencies', 'acronym', $this->sourceCurrency)
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
       $this->sourceCurrency->fill($this->form->getState())->save;

        Notification::make()
            ->title('Moeda adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('source-currencies.index');
    }
    public function render(): View
    {
        return view('livewire.source-currencies.edit');
    }
}
