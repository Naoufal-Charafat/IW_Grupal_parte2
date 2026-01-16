<?php

namespace App\Filament\Resources\Habitacions\Schemas;

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
                    ->required(),
                TextInput::make('capacidad')
                    ->required()
                    ->numeric(),
                Textarea::make('equipamiento')
                    ->columnSpanFull(),
                Toggle::make('esta_activo')
                    ->required(),
            ]);
    }
}
