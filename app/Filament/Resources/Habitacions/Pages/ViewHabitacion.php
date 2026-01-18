<?php

namespace App\Filament\Resources\Habitacions\Pages;

use App\Filament\Resources\Habitacions\HabitacionResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewHabitacion extends ViewRecord
{
    protected static string $resource = HabitacionResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Habitación')
                    ->schema([
                        TextEntry::make('nombre')
                            ->label('Nombre'),
                        TextEntry::make('capacidad')
                            ->label('Capacidad'),
                        TextEntry::make('equipamiento')
                            ->label('Equipamiento')
                            ->columnSpanFull(),
                        TextEntry::make('esta_activo')
                            ->label('Estado')
                            ->badge()
                            ->color(fn(bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn(bool $state): string => $state ? 'Activo' : 'Inactivo'),
                        TextEntry::make('tratamientos.nombre')
                            ->label('Tratamientos disponibles')
                            ->badge()
                            ->separator(',')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Reservas')
                    ->schema([
                        TextEntry::make('reservas_count')
                            ->label('Total de reservas')
                            ->state(fn($record) => $record->reservas()->count())
                            ->badge()
                            ->color('info'),
                    ]),
            ]);
    }
}
