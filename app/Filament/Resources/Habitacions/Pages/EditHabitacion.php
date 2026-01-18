<?php

namespace App\Filament\Resources\Habitacions\Pages;

use App\Filament\Resources\Habitacions\HabitacionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHabitacion extends EditRecord
{
    protected static string $resource = HabitacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
