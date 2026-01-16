<?php

namespace App\Filament\Resources\HorarioClinicas\Pages;

use App\Filament\Resources\HorarioClinicas\HorarioClinicaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHorarioClinica extends EditRecord
{
    protected static string $resource = HorarioClinicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
