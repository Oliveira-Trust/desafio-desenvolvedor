<?php

namespace App\Filament\Resources\ExchangeResource\Pages;

use App\Filament\Resources\ExchangeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExchange extends EditRecord
{
    protected static string $resource = ExchangeResource::class;

//    protected function getActions(): array
//    {
//        return [
//            Actions\DeleteAction::make(),
//        ];
//    }
}
