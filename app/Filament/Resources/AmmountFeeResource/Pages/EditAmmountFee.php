<?php

namespace App\Filament\Resources\AmmountFeeResource\Pages;

use App\Filament\Resources\AmmountFeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmmountFee extends EditRecord
{
    protected static string $resource = AmmountFeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
