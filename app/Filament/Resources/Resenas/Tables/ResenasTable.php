<?php

namespace App\Filament\Resources\Resenas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResenasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reserva.tratamiento.nombre')
                    ->label('Tratamiento')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('profesional.user.name')
                    ->label('Profesional')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reserva.fecha')
                    ->label('Fecha de la cita')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('puntuacion')
                    ->label('Puntuación')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state >= 4 => 'success',
                        $state >= 3 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn($state) => $state . ' ⭐'),
                TextColumn::make('comentario')
                    ->label('Comentario')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Fecha de reseña')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
