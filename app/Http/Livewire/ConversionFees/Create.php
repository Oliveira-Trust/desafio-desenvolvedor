<?php

namespace App\Http\Livewire\ConversionFees;

use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use App\Models\ConversionFee;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return ConversionFee::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('fee')
                ->label('Taxa')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->suffix('%')
                ->required(),
            Components\Select::make('conversion_fee_math_operator_id')
                ->label('Relação')
                ->relationship('conversionFeeMathOperator', 'description')
                ->required(),
            Components\TextInput::make('fee_relative_amount')
                ->label('Valor relativo à taxa')
                ->numeric()
                ->mask(
                    fn (Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->normalizeZeros(false)
                        ->thousandsSeparator('.')
                        ->decimalSeparator(',')
                )
                ->required(),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        ConversionFee::create($this->form->getState());

        Notification::make()
            ->title('Taxa de conversão adicionada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('conversion-fees.index');
    }

    public function render(): View
    {
        return view('livewire.conversion-fees.create');
    }
}
