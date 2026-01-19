<?php

namespace App\Filament\Resources\Reservas\Pages;

use App\Filament\Resources\Reservas\ReservaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListReservas extends ListRecords
{
    protected static string $resource = ReservaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        $user = auth()->user();

        // Si el usuario es profesional, mostrar solo sus reservas
        if ($user->hasRole('profesional')) {
            $profesional = $user->profesional;

            // Si no tiene un registro en la tabla profesionales, no mostrar nada
            if (!$profesional) {
                return static::getResource()::getEloquentQuery()->whereRaw('1 = 0');
            }

            // Filtrar solo las reservas de este profesional
            return static::getResource()::getEloquentQuery()
                ->where('profesional_id', $profesional->id);
        }

        // Si el usuario es cliente, mostrar solo sus reservas
        if ($user->hasRole('cliente')) {
            return static::getResource()::getEloquentQuery()
                ->where('user_id', $user->id);
        }

        // Para otros roles (recepcionista, admin), mostrar todas las reservas
        return parent::getTableQuery();
    }
}
