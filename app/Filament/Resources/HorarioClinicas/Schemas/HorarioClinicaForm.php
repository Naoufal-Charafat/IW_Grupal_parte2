<?php

namespace App\Filament\Resources\HorarioClinicas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HorarioClinicaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('dia')
                    ->required()
                    ->numeric(),
                TimePicker::make('hora_apertura')
                    ->required(),
                TimePicker::make('hora_cierre')
                    ->required(),
                Toggle::make('es_dia_laboral')
                    ->required(),
            ]);
    }
}
