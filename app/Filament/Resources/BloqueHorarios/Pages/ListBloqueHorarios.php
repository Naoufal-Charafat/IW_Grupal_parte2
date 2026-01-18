<?php

namespace App\Filament\Resources\BloqueHorarios\Pages;

use App\Filament\Resources\BloqueHorarios\BloqueHorarioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBloqueHorarios extends ListRecords
{
    protected static string $resource = BloqueHorarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
