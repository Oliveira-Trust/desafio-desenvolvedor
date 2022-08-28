<?php

namespace App\Http\Livewire\ConversionFees;

use Livewire\Component;

use App\Models\ConversionFee;
use App\Models\ConversionFeeMathOperator;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ConversionFee $conversionFee;

    protected function getFormModel(): ConversionFee
    {
        return $this->conversionFee;
    }

    public function mount($id): void
    {
        $this->conversionFee = ConversionFee::findOrFail($id);

        $this->form->fill([
            'title' => $this->conversionFee->title,
            'fee' => $this->conversionFee->fee,
        ]);
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
       $this->conversionFee->fill($this->form->getState())->save();

        Notification::make()
            ->title('Taxa de conversão atualizada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('conversion-fees.index');
    }
    public function render(): View
    {
        return view('livewire.conversion-fees.edit');
    }
}
