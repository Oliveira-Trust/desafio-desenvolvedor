<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmmountFeeResource\Pages;
use App\Filament\Resources\AmmountFeeResource\RelationManagers;
use App\Models\AmmountFee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AmmountFeeResource extends Resource
{
    protected static ?string $model = AmmountFee::class;
    public static function getNavigationGroup(): string
    {
        return __('Parameters');
    }
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ammount')
                    ->required(),
                Forms\Components\TextInput::make('fee')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ammount'),
                Tables\Columns\TextColumn::make('fee'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAmmountFees::route('/'),
            'create' => Pages\CreateAmmountFee::route('/create'),
            'edit' => Pages\EditAmmountFee::route('/{record}/edit'),
        ];
    }
}
