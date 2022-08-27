<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Quotation;
use Filament\Notifications\Notification;
use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
                ->prefix(fn (Quotation $record): string => $record->source_currency_symbol)
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('source_taxed_amount')
                ->label('Valor de Origem')
                ->description('(incluindo taxas)')
                ->prefix(fn (Quotation $record): string => $record->source_currency_symbol)
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('conversion_fee_amount')
                ->label('Taxa de conversão')
                ->prefix(fn (Quotation $record): string => $record->source_currency_symbol)
                ->description(fn (Quotation $record):string => "Taxa de " . $record->conversion_fee_percentage . "%")
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('payment_method_fee_amount')
                ->label('Taxa do método de pagamento')
                ->prefix(fn (Quotation $record): string => $record->source_currency_symbol)
                ->description(fn (Quotation $record):string => "Taxa de " . $record->payment_method_fee_percentage . "%")
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('target_amount')
                ->label('Valor convertido')
                ->prefix(fn (Quotation $record): string => $record->target_currency_symbol)
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
