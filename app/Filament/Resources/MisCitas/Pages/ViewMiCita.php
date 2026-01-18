<?php

namespace App\Filament\Resources\MisCitas\Pages;

use App\Filament\Resources\MisCitas\MisCitasResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\ViewRecord;

class ViewMiCita extends ViewRecord
{
    protected static string $resource = MisCitasResource::class;

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                Section::make('Información de la Cita')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('codigo_confirmacion')
                                    ->label('Código de Confirmación')
                                    ->badge()
                                    ->color('info')
                                    ->copyable(),
                                    
                                TextEntry::make('estado')
                                    ->label('Estado')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'confirmado' => 'success',
                                        'bloqueado' => 'warning',
                                        'completado' => 'info',
                                        'cancelado' => 'danger',
                                        'no_asistio' => 'danger',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'confirmado' => 'Confirmada',
                                        'bloqueado' => 'Bloqueada',
                                        'completado' => 'Completada',
                                        'cancelado' => 'Cancelada',
                                        'no_asistio' => 'No Asistió',
                                        'borrador' => 'Borrador',
                                        default => ucfirst($state),
                                    }),
                            ]),
                    ]),
                    
                Section::make('Fecha y Hora')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('fecha')
                                    ->label('Fecha')
                                    ->date('l, d \d\e F \d\e Y')
                                    ->icon('heroicon-o-calendar'),
                                    
                                TextEntry::make('hora_inicio')
                                    ->label('Hora de Inicio')
                                    ->time('H:i')
                                    ->icon('heroicon-o-clock'),
                                    
                                TextEntry::make('hora_fin')
                                    ->label('Hora de Fin')
                                    ->time('H:i')
                                    ->icon('heroicon-o-clock'),
                            ]),
                            
                        TextEntry::make('duracion_minutos')
                            ->label('Duración')
                            ->suffix(' minutos')
                            ->icon('heroicon-o-clock'),
                    ]),
                    
                Section::make('Servicio')
                    ->schema([
                        TextEntry::make('tratamiento.nombre')
                            ->label('Tratamiento'),
                            
                        TextEntry::make('tratamiento.descripcion')
                            ->label('Descripción')
                            ->columnSpanFull(),
                            
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('profesional.user.name')
                                    ->label('Profesional')
                                    ->icon('heroicon-o-user'),
                                    
                                TextEntry::make('habitacion.nombre')
                                    ->label('Sala')
                                    ->icon('heroicon-o-building-office'),
                            ]),
                    ]),
                    
                Section::make('Información de Pago')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('monto_total')
                                    ->label('Importe Total')
                                    ->money('EUR')
                                    ->size('lg')
                                    ->weight('bold'),
                                    
                                TextEntry::make('estado_pago')
                                    ->label('Estado del Pago')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pagado' => 'success',
                                        'pendiente' => 'warning',
                                        'no_pagado' => 'danger',
                                        'reembolsado' => 'info',
                                        'fallido' => 'danger',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'pagado' => 'Pagado',
                                        'pendiente' => 'Pendiente',
                                        'no_pagado' => 'No Pagado',
                                        'reembolsado' => 'Reembolsado',
                                        'fallido' => 'Fallido',
                                        default => ucfirst($state),
                                    }),
                            ]),
                    ]),
                    
                Section::make('Notas')
                    ->schema([
                        TextEntry::make('notas')
                            ->label('Notas Adicionales')
                            ->placeholder('Sin notas')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(fn ($record) => empty($record->notas)),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cancelar')
                ->label('Cancelar Cita')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => $this->canCancelReservation())
                ->requiresConfirmation()
                ->modalHeading('Cancelar Cita')
                ->modalDescription('¿Estás seguro de que deseas cancelar esta cita? Esta acción no se puede deshacer.')
                ->modalSubmitActionLabel('Sí, cancelar')
                ->action(function () {
                    $this->record->update(['estado' => 'cancelado']);
                    
                    Notification::make()
                        ->title('Cita cancelada')
                        ->success()
                        ->body('Tu cita ha sido cancelada correctamente.')
                        ->send();
                    
                    return redirect()->to(MisCitasResource::getUrl('index'));
                })
                ->disabled(fn () => !$this->canCancelReservation())
                ->tooltip(fn () => !$this->canCancelReservation() ? 'No se puede cancelar una cita con menos de 24 horas de antelación' : null),
            
            Actions\Action::make('volver')
                ->label('Volver a Mis Citas')
                ->url(MisCitasResource::getUrl('index'))
                ->color('gray'),
        ];
    }
    
    protected function canCancelReservation(): bool
    {
        // Only allow cancellation if reservation is confirmed or blocked
        if (!in_array($this->record->estado, ['confirmado', 'bloqueado'])) {
            return false;
        }
        
        // Check if reservation is more than 24 hours away
        $fecha = $this->record->fecha instanceof Carbon ? $this->record->fecha->format('Y-m-d') : $this->record->fecha;
        $hora = $this->record->hora_inicio instanceof Carbon ? $this->record->hora_inicio->format('H:i:s') : $this->record->hora_inicio;
        $reservationDateTime = Carbon::parse("$fecha $hora");
        $now = Carbon::now();
        
        // Check if reservation is in the future and more than 24 hours away
        return $reservationDateTime->isFuture() && $now->diffInHours($reservationDateTime) >= 24;
    }
}
