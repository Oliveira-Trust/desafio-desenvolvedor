<?php

namespace App\Http\Livewire\TargetCurrencies;

use App\Models\TargetCurrency;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public TargetCurrency $targetCurrency;

    protected function getFormModel(): TargetCurrency
    {
        return $this->targetCurrency;
    }

    public function mount($id): void
    {
        $this->targetCurrency = TargetCurrency::findOrFail($id);

        $this->form->fill([
            'acronym' => $this->targetCurrency->acronym,
            'symbol' => $this->targetCurrency->symbol,
            'description' => $this->targetCurrency->description,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('acronym')
                ->label('Sigla')
                ->unique('currencies', 'acronym', $this->targetCurrency)
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
       $this->targetCurrency->fill($this->form->getState())->save;

        Notification::make()
            ->title('Moeda adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('target-currencies.index');
    }
    public function render(): View
    {
        return view('livewire.target-currencies.edit');
    }
}
