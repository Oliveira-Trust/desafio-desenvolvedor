<?php

namespace App\Filament\Pages;

use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Services\ExchangeService;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Filament\Forms;

class ExchangeCreate extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.exchange-create';

    public function getTitle(): string
    {
        return __('New Exchange');
    }
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): string
    {
        return __('Exchange');
    }

    public static function getNavigationLabel(): string
    {
        return __('New Exchange');
    }



    public $currency;
    public $payment_method;
    public $ammount;

    protected function getFormSchema(): array
    {

        return [
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Select::make('currency')
                        ->label(__('Currency'))
                        ->options(Currency::all()->sortBy('name')->pluck('name', 'code'))
                        ->required()
                        ->searchable(),
                    Forms\Components\Select::make('payment_method')
                        ->label(__('Payment Method'))
                        ->options(PaymentMethod::all()->sortBy('name')->pluck('name', 'method'))
                        ->required()
                        ->searchable(),
                    Forms\Components\TextInput::make('ammount')->label('Ammount')
                        ->numeric()
                        ->gte(1000)
                        ->lte(100000)
                        ->required(),
                ])->columns(['sm' => 1, 'md' => 1])
        ];
    }

    public function proces()
    {
        $params = $this->form->getState();
        $service = new ExchangeService();
        $service->create($params['currency'], $params['payment_method'], $params['ammount']);
        $this->form->fill(['currency' => '', 'payment_method' => '', 'ammount' => '']);
        Notification::make()
            ->title('Exchange created')
            ->body('Currency exchange was created.')
            ->success()
            ->send();
    }

    protected function getActions(): array
    {
        return [
            Action::make('Create Exchange')->action('proces'),
        ];
    }


}
