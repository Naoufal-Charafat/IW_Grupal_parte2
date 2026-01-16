<?php

namespace App\Filament\Resources\Habitacions\Pages;

use App\Filament\Resources\Habitacions\HabitacionResource;
use App\Filament\Resources\Reservas\ReservaResource;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Activo' : 'Inactivo'),
                        TextEntry::make('tratamientos.nombre')
                            ->label('Tratamientos disponibles')
                            ->badge()
                            ->separator(',')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Reservas')
                    ->schema([
                        \Filament\Infolists\Components\TableSection::make('reservas')
                            ->heading('Reservas asociadas a esta habitación')
                            ->table(fn (Table $table) => $table
                                ->query(fn () => $this->record->reservas()->getQuery())
                                ->columns([
                                    TextColumn::make('codigo_confirmacion')
                                        ->label('Código')
                                        ->searchable()
                                        ->sortable(),
                                    TextColumn::make('nombre_paciente')
                                        ->label('Paciente')
                                        ->searchable(),
                                    TextColumn::make('profesional.nombre')
                                        ->label('Profesional')
                                        ->searchable(),
                                    TextColumn::make('tratamiento.nombre')
                                        ->label('Tratamiento')
                                        ->searchable(),
                                    TextColumn::make('fecha')
                                        ->label('Fecha')
                                        ->date('d/m/Y')
                                        ->sortable(),
                                    TextColumn::make('hora_inicio')
                                        ->label('Hora')
                                        ->time('H:i'),
                                    TextColumn::make('estado')
                                        ->label('Estado')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            'confirmado' => 'success',
                                            'pendiente' => 'warning',
                                            'cancelado' => 'danger',
                                            'bloqueado' => 'gray',
                                            default => 'info',
                                        }),
                                ])
                                ->recordAction(null)
                                ->recordActions([
                                    EditAction::make()
                                        ->label('Editar')
                                        ->url(fn ($record) => ReservaResource::getUrl('edit', ['record' => $record]))
                                ])
                                ->emptyStateHeading('No hay reservas')
                                ->emptyStateDescription('Esta habitación no tiene reservas asociadas todavía.')
                            )
                    ])
            ]);
    }
}
