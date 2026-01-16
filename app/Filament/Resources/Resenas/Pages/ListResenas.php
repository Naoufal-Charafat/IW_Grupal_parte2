<?php

namespace App\Filament\Resources\Resenas\Pages;

use App\Filament\Resources\Resenas\ResenaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResenas extends ListRecords
{
    protected static string $resource = ResenaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
