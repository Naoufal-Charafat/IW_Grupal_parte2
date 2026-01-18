<?php

namespace App\Filament\Resources\HorarioClinicas\Pages;

use App\Filament\Resources\HorarioClinicas\HorarioClinicaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHorarioClinicas extends ListRecords
{
    protected static string $resource = HorarioClinicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
