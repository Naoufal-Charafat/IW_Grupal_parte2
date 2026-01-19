<?php

namespace App\Filament\Resources\Tratamientos\Pages;

use App\Filament\Resources\Tratamientos\TratamientoResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTratamiento extends CreateRecord
{
    protected static string $resource = TratamientoResource::class;

    /**
     * Hook ejecutado después de crear el tratamiento
     * Si el usuario es profesional, asigna automáticamente el tratamiento a sí mismo
     */
    protected function afterCreate(): void
    {
        $user = auth()->user();

        // Si el usuario autenticado es profesional, asignar el tratamiento automáticamente
        if ($user->hasRole('profesional') && $user->profesional) {
            $this->record->profesionales()->attach($user->profesional->id);
        }
    }
}
