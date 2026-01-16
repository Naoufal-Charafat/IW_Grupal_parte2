<?php

namespace App\Filament\Resources\Tratamientos\Pages;

use App\Filament\Resources\Tratamientos\TratamientoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTratamientos extends ListRecords
{
    protected static string $resource = TratamientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
