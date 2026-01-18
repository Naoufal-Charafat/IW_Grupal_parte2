<?php

namespace App\Filament\Resources\Profesionals\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Tratamiento;

class ProfesionalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Selecciona el usuario que será asignado como profesional'),
                TextInput::make('numero_licencia')
                    ->label('Número de Licencia')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Número de licencia profesional'),
                Textarea::make('biografia')
                    ->label('Biografía')
                    ->rows(4)
                    ->columnSpanFull()
                    ->helperText('Descripción profesional y experiencia'),
                TextInput::make('tarifa_hora')
                    ->label('Tarifa por Hora (€)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->prefix('€')
                    ->helperText('Tarifa estándar por hora de servicio'),
                Select::make('tratamientos')
                    ->label('Tratamientos')
                    ->relationship('tratamientos', 'nombre')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return Tratamiento::where('esta_activo', true)
                            ->pluck('nombre', 'id');
                    })
                    ->columnSpanFull()
                    ->helperText('Selecciona los tratamientos que este profesional puede realizar'),
            ]);
    }
}
