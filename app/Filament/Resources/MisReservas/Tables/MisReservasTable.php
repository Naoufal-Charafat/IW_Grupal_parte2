<?php

namespace App\Filament\Resources\MisReservas\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MisReservasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_confirmacion')
                    ->label('Código')
                    ->searchable()
                    ->copyable()
                    ->badge()
                    ->color('info'),
                    
                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                    
                TextColumn::make('hora_inicio')
                    ->label('Hora')
                    ->time('H:i')
                    ->sortable(),
                    
                TextColumn::make('tratamiento.nombre')
                    ->label('Tratamiento')
                    ->searchable()
                    ->wrap(),
                    
                TextColumn::make('profesional.user.name')
                    ->label('Profesional')
                    ->searchable(),
                    
                TextColumn::make('habitacion.nombre')
                    ->label('Sala')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('duracion_minutos')
                    ->label('Duración')
                    ->suffix(' min')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('estado')
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
                    
                TextColumn::make('estado_pago')
                    ->label('Pago')
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
                    
                TextColumn::make('monto_total')
                    ->label('Importe')
                    ->money('EUR')
                    ->sortable(),
            ])
            ->defaultSort('fecha', 'desc')
            ->filters([
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'borrador' => 'Borrador',
                        'bloqueado' => 'Bloqueada',
                        'confirmado' => 'Confirmada',
                        'completado' => 'Completada',
                        'cancelado' => 'Cancelada',
                        'no_asistio' => 'No Asistió',
                    ])
                    ->multiple(),
                    
                SelectFilter::make('estado_pago')
                    ->label('Estado de Pago')
                    ->options([
                        'no_pagado' => 'No Pagado',
                        'pendiente' => 'Pendiente',
                        'pagado' => 'Pagado',
                        'reembolsado' => 'Reembolsado',
                        'fallido' => 'Fallido',
                    ])
                    ->multiple(),
                    
                Filter::make('proximas')
                    ->label('Próximas Reservas')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('fecha', '>=', now()->toDateString())
                        ->whereIn('estado', ['confirmado', 'bloqueado'])
                    )
                    ->default(),
                    
                Filter::make('historial')
                    ->label('Historial')
                    ->query(fn (Builder $query): Builder => $query
                        ->where(function($q) {
                            $q->where('fecha', '<', now()->toDateString())
                              ->orWhereIn('estado', ['completado', 'cancelado', 'no_asistio']);
                        })
                    ),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('Ver Detalles')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => route('filament.admin.resources.mis-reservas.view', ['record' => $record])),
            ])
            ->emptyStateHeading('No tienes reservas')
            ->emptyStateDescription('Cuando reserves una cita, aparecerá aquí.')
            ->emptyStateIcon('heroicon-o-calendar');
    }
}
