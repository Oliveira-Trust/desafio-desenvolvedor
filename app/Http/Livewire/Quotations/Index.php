<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Quotation;
use Closure;
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
            ?  Quotation::query()->latest()
            :  Quotation::query()->latest()->whereBelongsTo(auth()->user());
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
                Tables\Columns\TextColumn::make('sourceCurrency.acronym')
                    ->label('Moeda de Origem')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('targetCurrency.acronym')
                    ->label('Moeda de Destino')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('source_amount')
                    ->label('Valor de Origem')
                    ->description('(sem taxas)')
                    ->money(fn (Quotation $record): string => $record->sourceCurrency->acronym, true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('source_taxed_amount')
                    ->label('Valor de Origem')
                    ->description('(incluindo taxas)')
                    ->money(fn (Quotation $record): string => $record->sourceCurrency->acronym, true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('conversion_fee_amount')
                    ->label('Taxa de conversão')
                    ->money(fn (Quotation $record): string => $record->sourceCurrency->acronym, true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_amount')
                    ->label('Valor convertido')
                    ->money(fn (Quotation $record): string => $record->targetCurrency->acronym, true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method_fee_amount')
                    ->label('Taxa do método de pagamento')
                    ->money(fn (Quotation $record): string => $record->sourceCurrency->acronym, true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('paymentMethod.title')
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

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Quotation $record): string => route('quotations.edit', ['id' => $record->id]);
    }

    protected function getTableActions(): array
    {
        return [ 
            Tables\Actions\EditAction::make('visualizar')
                ->icon('heroicon-o-eye')
                ->url(fn (Quotation $record): string => route('quotations.edit', ['id' => $record->id])),
            Tables\Actions\DeleteAction::make('excluir')
                ->modalHeading('Excluir cotação')
                ->icon('heroicon-o-trash')
                ->action(fn (Quotation $record) => $record->delete())
        ]; 
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

    public function render(): View
    {
        return view('livewire.quotations.index');
    }
}
