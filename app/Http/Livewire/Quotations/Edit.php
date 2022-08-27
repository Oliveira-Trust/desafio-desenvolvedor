<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\Quotation;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Quotation $quotation;

    protected function getFormModel(): Quotation
    {
        return $this->quotation;
    } 

    public function mount($id): void
    {
        $this->quotation = Quotation::findOrFail($id);
        
        $this->form->fill([
            'source_currency_id' => $this->quotation->source_currency_id,
            'target_currency_id' => $this->quotation->target_currency_id,
            'payment_method_id' => $this->quotation->payment_method_id,
            'source_amount' => $this->quotation->source_amount,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Components\Select::make('source_currency_acronym')
                ->label('Moeda de origem')
                ->reactive()
                ->exists(Currency::class, 'acronym')
                ->options(Currency::query()->where('acronym', 'BRL')->pluck('acronym', 'acronym'))
                ->getOptionLabelFromRecordUsing(fn (Currency $record) => "$record->acronym - $record->description")
                ->required(),
            Components\Select::make('target_currency_acronym')
                ->label('Moeda de destino')
                ->reactive()
                ->options(fn ($get) => Currency::query()->where('acronym', '!=', $get('source_currency'))->pluck('acronym', 'acronym'))
                ->getOptionLabelFromRecordUsing(fn (Currency $record) => "$record->acronym - $record->description")
                ->required(),
            Components\Select::make('payment_method')
                ->label('Método de pagamento')
                ->options(fn () => PaymentMethod::all()->pluck('title', 'id'))
                ->getOptionLabelFromRecordUsing(fn (PaymentMethod $record) => "$record->title - taxa de " . number_format($record->fee * 100, 2, ',', '.') . "%")
                ->required(),
            Components\TextInput::make('source_amount')
                ->label('Valor para conversão')
                ->prefix(function (Quotation $record): string {
                    $currency = Currency::query()->where('acronym', $record->source_currency)->first();
                    
                    if ($currency) {
                        return $currency->symbol;
                    }

                    return "$record->source_currency ";
                })
                ->numeric()
                ->mask(
                    fn (Components\TextInput\Mask $mask) => $mask
                    ->numeric()
                    ->decimalPlaces(2)
                    ->normalizeZeros(false)
                    ->thousandsSeparator('.')
                    ->decimalSeparator(',')
                )
                ->rules([
                    'required',
                    function () {
                        return function (string $attribute, $value, $fail) {
                            if ($value < 1000) {
                                $fail("O valor mínimo para conversão é de R$1000,00");
                            } elseif ($value > 100000) {
                                $fail("O valor máximo para conversão é de R$100.000,00");
                            }
                        };
                    },
                    
                ])
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $quotation = Quotation::getUpdatedQuotationValues($this->form->getState());

        $this->quotation->fill($quotation)->save();

        Notification::make()
            ->title('Cotação atualizada com sucesso!')
            ->success()
            ->send();

        return redirect()->route('quotations.index');
    }
    public function render(): View
    {
        return view('livewire.quotations.edit');
    }
}
