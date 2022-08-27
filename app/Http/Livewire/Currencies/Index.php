<?php

namespace App\Http\Livewire\Currencies;

use App\Models\Currency;
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
        return Currency::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y H:i')
                ->label('Data de Criação')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('acronym')
                ->label('Sigla')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('symbol')
                ->label('Símbolo')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('description')
                ->label('Descrição')
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('editar')
                ->icon('heroicon-o-pencil')
                ->url(fn (Currency $record): string => route('currencies.edit', ['id' => $record->id])),
            Tables\Actions\DeleteAction::make('excluir')
                ->modalHeading('Excluir moeda')
                ->icon('heroicon-o-trash')
                ->action(fn (Currency $record) => $record->delete())
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
