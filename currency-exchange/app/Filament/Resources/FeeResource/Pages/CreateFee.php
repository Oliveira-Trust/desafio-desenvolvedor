<?php

namespace App\Filament\Resources\FeeResource\Pages;

use App\Filament\Resources\FeeResource;
use App\Models\Fee;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Http;

class CreateFee extends CreateRecord
{
    protected static string $resource = FeeResource::class;

    protected function handleRecordCreation(array $data): Fee
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->createToken('auth_token')->plainTextToken
        ])
            ->post('laravel.test/api/v1/fees', $data);

        if (!$response->successful()) {
            Notification::make()
                ->title('Erro')
                ->body(($response->json())['message'])
                ->danger()
                ->send();
            throw new Halt('halt');
        }

        return new Fee($response->json());
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
