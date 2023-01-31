<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeResource\Pages;
use App\Filament\Resources\ExchangeResource\RelationManagers;
use App\Models\Exchange;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExchangeResource extends Resource
{
    protected static ?string $model = Exchange::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 5;

    public function getTitle(): string
    {
        return __('List Exchanges');
    }

    public static function getNavigationGroup(): string
    {
        return __('Exchange');
    }

    public static function getNavigationLabel(): string
    {
        return __('List Exchanges');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('currency')
                    ->required(),
                Forms\Components\TextInput::make('method')
                    ->required(),
                Forms\Components\TextInput::make('ammount')
                    ->required(),
                Forms\Components\TextInput::make('ammount_fee')
                    ->required(),
                Forms\Components\TextInput::make('method_fee')
                    ->required(),
                Forms\Components\TextInput::make('net_ammount')
                    ->required(),
                Forms\Components\TextInput::make('exchange_rate')
                    ->required(),
                Forms\Components\TextInput::make('converted_ammount')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('currency')->searchable(),
                Tables\Columns\TextColumn::make('method')->searchable(),
                Tables\Columns\TextColumn::make('ammount')->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('ammount_fee')->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('method_fee')->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('net_ammount')->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('exchange_rate'),
                Tables\Columns\TextColumn::make('converted_ammount')->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchanges::route('/'),
//            'create' => Pages\CreateExchange::route('/create'),
//            'edit' => Pages\EditExchange::route('/{record}/edit'),
        ];
    }
}
