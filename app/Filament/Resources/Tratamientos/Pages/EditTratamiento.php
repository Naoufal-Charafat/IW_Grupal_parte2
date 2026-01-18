<?php

namespace App\Filament\Resources\Tratamientos\Pages;

use App\Filament\Resources\Tratamientos\TratamientoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTratamiento extends EditRecord
{
    protected static string $resource = TratamientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
