<?php

namespace App\Filament\Resources\Tratamientos\Pages;

use App\Filament\Resources\Tratamientos\TratamientoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTratamientos extends ListRecords
{
    protected static string $resource = TratamientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        $user = auth()->user();

        // Si el usuario es profesional, mostrar solo sus tratamientos
        if ($user->hasRole('profesional')) {
            $profesional = $user->profesional;

            // Si no tiene un registro en la tabla profesionales, no mostrar nada
            if (!$profesional) {
                return static::getResource()::getEloquentQuery()->whereRaw('1 = 0');
            }

            // Obtener los IDs de los tratamientos del profesional
            $tratamientoIds = $profesional->tratamientos()->pluck('tratamientos.id');

            return static::getResource()::getEloquentQuery()
                ->whereIn('id', $tratamientoIds);
        }

        // Para otros roles, mostrar todos los tratamientos
        return parent::getTableQuery();
    }
}
