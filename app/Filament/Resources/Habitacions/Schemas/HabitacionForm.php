<?php

namespace App\Filament\Resources\Habitacions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HabitacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required()
                    ->label('Nombre'),
                TextInput::make('capacidad')
                    ->required()
                    ->numeric()
                    ->label('Capacidad'),
                Textarea::make('equipamiento')
                    ->columnSpanFull()
                    ->label('Equipamiento'),
                Toggle::make('esta_activo')
                    ->required()
                    ->label('Está activo')
                    ->default(true),
                Select::make('tratamientos')
                    ->relationship('tratamientos', 'nombre')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Tratamientos disponibles')
                    ->helperText('Selecciona los tratamientos que se pueden realizar en esta habitación')
                    ->columnSpanFull(),
            ]);
    }
}
