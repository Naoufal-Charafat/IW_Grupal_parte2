<?php

namespace App\Filament\Resources\Resenas\Pages;

use App\Filament\Resources\Resenas\ResenaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateResena extends CreateRecord
{
    protected static string $resource = ResenaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return '¡Reseña creada exitosamente!';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Asegurar que el cliente_id es el usuario autenticado
        $data['cliente_id'] = auth()->id();

        return $data;
    }
}
