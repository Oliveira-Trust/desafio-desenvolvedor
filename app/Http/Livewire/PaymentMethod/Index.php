<?php

namespace App\Http\Livewire\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;

use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    
    protected function getTableQuery(): Builder
    {
        return PaymentMethod::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data de Criação')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('title')
                ->label('Título')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('fee')
                ->label('Taxa')
                ->suffix("%")
                ->formatStateUsing(fn (?string $state):string => number_format($state, 2, ',', '.'))
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('editar')
                ->icon('heroicon-o-pencil')
                ->url(fn (PaymentMethod $record): string => route('payment-methods.edit', ['id' => $record->id])),
            Tables\Actions\DeleteAction::make('excluir')
                ->modalHeading('Excluir forma de pagamento')
                ->icon('heroicon-o-trash')
                ->action(fn (PaymentMethod $record) => $record->delete())
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
}
