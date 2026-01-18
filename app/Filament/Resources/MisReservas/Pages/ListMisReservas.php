<?php

namespace App\Filament\Resources\MisReservas\Pages;

use App\Filament\Resources\MisReservas\MisReservasResource;
use App\Filament\Widgets\CancelacionInfoWidget;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListMisReservas extends ListRecords
{
    protected static string $resource = MisReservasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('nueva_reserva')
                ->label('Reservar Nueva Cita')
                ->icon('heroicon-o-plus')
                ->color('success')
                ->url(route('tratamientos.index'))
                ->visible(fn (): bool => auth()->user()->hasRole('cliente')),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Mis Reservas';
    }
    
    public function getHeaderWidgets(): array
    {
        return [
            CancelacionInfoWidget::class,
        ];
    }
}
