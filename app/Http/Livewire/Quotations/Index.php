<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Currency;
use App\Models\Quotation;
use Filament\Notifications\Notification;
use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    
    protected function getTableQuery(): Builder
    {
        return auth()->user()->admin
            ? Quotation::query()->latest()
            : Quotation::query()->latest()->whereBelongsTo(auth()->user());
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->hidden(!auth()->user()->admin)
                ->label('Usuário')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('source_currency_acronym')
                ->label('Moeda de Origem')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('target_currency_acronym')
                ->label('Moeda de Destino')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('source_amount')
                ->label('Valor de Origem')
                ->description('(sem taxas)')
                ->prefix(function (Quotation $record): string {
                    $currency = Currency::query()->where('acronym', $record->source_currency_acronym)->first();
                    
                    if ($currency) {
                        return $currency->symbol;
                    }

                    return "$record->source_currency_acronym ";
                })
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('source_taxed_amount')
                ->label('Valor de Origem')
                ->description('(incluindo taxas)')
                ->prefix(function (Quotation $record): string {
                    $currency = Currency::query()->where('acronym', $record->source_currency_acronym)->first();
                    
                    if ($currency) {
                        return $currency->symbol;
                    }

                    return "$record->source_currency_acronym ";
                })
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('conversion_fee_amount')
                ->label('Taxa de conversão')
                ->prefix(function (Quotation $record): string {
                    $currency = Currency::query()->where('acronym', $record->source_currency_acronym)->first();
                    
                    if ($currency) {
                        return $currency->symbol;
                    }

                    return "$record->source_currency_acronym ";
                })
                ->description(fn (Quotation $record):string => "Taxa de " . $record->conversion_fee_percentage * 100 . "%")
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('target_amount')
                ->label('Valor convertido')
                ->prefix(function (Quotation $record): string {
                    $currency = Currency::query()->where('acronym', $record->target_currency_acronym)->first();
                    
                    if ($currency) {
                        return $currency->symbol;
                    }

                    return "$record->target_currency_acronym ";
                })
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('payment_method_fee_amount')
                ->label('Taxa do método de pagamento')
                ->prefix(function (Quotation $record): string {
                    $currency = Currency::query()->where('acronym', $record->source_currency_acronym)->first();
                    
                    if ($currency) {
                        return $currency->symbol;
                    }

                    return "$record->source_currency_acronym ";
                })
                ->description(fn (Quotation $record):string => "Taxa de " . $record->payment_method_fee_percentage * 100 . "%")
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('payment_method')
                ->label('Método de Pagamento')
                ->sortable()
                ->searchable(),
            Tables\Columns\BadgeColumn::make('payment_status')
                ->label('Status do Pagamento')
                ->sortable()
                ->searchable()
                ->colors([
                    'warning' => 'Em aberto',
                    'danger' => 'Cancelado',
                    'success' => 'Pago',
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        $actions = [
            Tables\Actions\Action::make('Efetuar pagamento')
                ->icon('heroicon-o-currency-dollar')
                ->action(function (Quotation $record) {
                    $record->payment_status = "Pago";
                    $record->save();

                    Notification::make()
                        ->title('Pago com sucesso!')
                        ->success()
                        ->send();
                })
        ];

        if (auth()->user()->admin) {
            array_push(
                $actions,
                Tables\Actions\EditAction::make('editar')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Quotation $record): string => route('quotations.edit', ['id' => $record->id])),
                Tables\Actions\DeleteAction::make('excluir')
                    ->modalHeading('Excluir cotação')
                    ->icon('heroicon-o-trash')
                    ->action(fn (Quotation $record) => $record->delete())
            );
        }

        return $actions;
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('excluir')
                ->label('Excluir selecionados')
                ->color('danger')
                ->action(function (Collection $records): void {
                    $records->each->delete();
                })
                ->requiresConfirmation(),
        ];
    }
}
