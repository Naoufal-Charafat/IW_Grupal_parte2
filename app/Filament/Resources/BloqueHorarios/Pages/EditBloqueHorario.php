<?php

namespace App\Filament\Resources\BloqueHorarios\Pages;

use App\Filament\Resources\BloqueHorarios\BloqueHorarioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBloqueHorario extends EditRecord
{
    protected static string $resource = BloqueHorarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
