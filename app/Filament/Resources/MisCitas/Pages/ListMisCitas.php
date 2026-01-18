<?php

namespace App\Filament\Resources\MisCitas\Pages;

use App\Filament\Resources\MisCitas\MisCitasResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListMisCitas extends ListRecords
{
    protected static string $resource = MisCitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('nueva_cita')
                ->label('Reservar Nueva Cita')
                ->icon('heroicon-o-plus')
                ->color('success')
                ->url(route('tratamientos.index'))
                ->visible(fn (): bool => auth()->user()->hasRole('cliente')),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Mis Citas';
    }
}
