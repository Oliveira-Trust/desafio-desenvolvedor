<?php

namespace App\Http\Livewire\Quotations;

use App\Http\Services\ExchangeApiService;
use App\Models\PaymentMethod;
use App\Models\Quotation;
use App\Models\SourceCurrency;
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
        return Quotation::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Components\Select::make('source_currency_id')
                ->label('Moeda de origem')
                ->reactive()
                ->exists(SourceCurrency::class, 'id')
                ->options(fn ($get) => SourceCurrency::query()->where('acronym', '!=', TargetCurrency::find($get('target_currency_id'))?->acronym)->get()->pluck('acronym_description', 'id'))
                ->required(),
            Components\Select::make('target_currency_id')
                ->label('Moeda de destino')
                ->reactive()
                ->exists(TargetCurrency::class, 'id')
                ->options(fn ($get) => TargetCurrency::query()->where('acronym', '!=', SourceCurrency::find($get('source_currency_id'))?->acronym)->get()->pluck('acronym_description', 'id'))
                ->required(),
            Components\Select::make('payment_method_id')
                ->label('Método de pagamento')
                ->options(fn () => PaymentMethod::all()->pluck('title_fee', 'id'))
                ->required(),
            Components\TextInput::make('source_amount')
                ->label('Valor para conversão')
                ->prefix(fn ($get): string => SourceCurrency::find($get('source_currency_id'))?->symbol ?? '')
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
        $updatedQuotationValues = ExchangeApiService::getUpdatedQuotationValues($this->form->getState());

        Quotation::create($updatedQuotationValues);

        Notification::make()
            ->title('Cotação realizada!')
            ->success()
            ->send();

        return redirect()->route('quotations.index');
    } 

    public function render(): View
    {
        return view('livewire.quotations.create');
    }
}
