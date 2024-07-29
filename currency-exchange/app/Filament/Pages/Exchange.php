<?php

namespace App\Filament\Pages;

use App\Helpers\CurrencyEnum;
use App\Models\PaymentMethod;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Illuminate\Support\Facades\Http;

class Exchange extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.exchange';

    public $end_currency;
    public $amount;
    public $payment_method_id;

    public function submit()
    {
        $data = [
            'end_currency' => $this->end_currency,
            'amount' => $this->amount,
            'payment_method_id' => $this->payment_method_id,
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->createToken('auth_token')->plainTextToken
        ])->post('http://laravel.test/api/v1/exchanges', $data);

        if ($response->successful()) {
            Notification::make()
                ->title('Sucesso')
                ->body('Dados enviados com sucesso.')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Erro')
                ->body($response->json()['message'] ?? null)
                ->danger()
                ->send();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('end_currency')
                ->options([
                    CurrencyEnum::EUR->name => 'Euro',
                    CurrencyEnum::USD->name => 'US Dolar',
                    CurrencyEnum::BTC->name => 'Bitcoin',
                    CurrencyEnum::GBP->name => 'British Pound'
                ])
                ->label('End currency')
                ->required(),
            TextInput::make('amount')
                ->label('Amount')
                ->numeric()
                ->required(),
            Select::make('payment_method_id')
                ->options(PaymentMethod::all()->pluck('name', 'id'))
                ->label('Payment method')
                ->required(),
            Actions::make([
                Action::make('submit')
                    ->label('Enviar')
                    ->action('submit'),
            ])->alignCenter(true)
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('origin_currency')->label('Origin Currency')->size(TextColumnSize::Small),
            TextColumn::make('end_currency')->label('End Currency'),
            TextColumn::make('amount')->label('Amount'),
            TextColumn::make('payment_method')->label('Payment method'),
            TextColumn::make('end_currency_amount')->label('New Currency amount'),
            TextColumn::make('payment_fee')->label('Payment fee'),
            TextColumn::make('conversion_fee')->label('Conversion fee'),
            TextColumn::make('amount_converted')->label('Amount converted'),
        ];
    }

    protected function getTableData(): array
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->createToken('auth_token')->plainTextToken
        ])
            ->get('laravel.test/api/v1/exchanges', []);

        return $response->json();
    }
}
