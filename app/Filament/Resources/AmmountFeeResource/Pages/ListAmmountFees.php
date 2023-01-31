<?php

namespace App\Filament\Resources\AmmountFeeResource\Pages;

use App\Filament\Resources\AmmountFeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmmountFees extends ListRecords
{
    protected static string $resource = AmmountFeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
