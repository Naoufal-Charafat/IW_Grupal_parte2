<?php

namespace App\Filament\Resources\Profesionals\Pages;

use App\Filament\Resources\Profesionals\ProfesionalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfesionals extends ListRecords
{
    protected static string $resource = ProfesionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
