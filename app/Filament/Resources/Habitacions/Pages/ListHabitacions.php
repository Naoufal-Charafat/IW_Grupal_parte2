<?php

namespace App\Filament\Resources\Habitacions\Pages;

use App\Filament\Resources\Habitacions\HabitacionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHabitacions extends ListRecords
{
    protected static string $resource = HabitacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
