<?php

namespace App\Filament\Resources\HorarioClinicas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HorarioClinicaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('dia')
                    ->label('Día de la semana')
                    ->options([
                        0 => 'Domingo',
                        1 => 'Lunes',
                        2 => 'Martes',
                        3 => 'Miércoles',
                        4 => 'Jueves',
                        5 => 'Viernes',
                        6 => 'Sábado',
                    ])
                    ->required(),
                TimePicker::make('hora_apertura')
                    ->required(),
                TimePicker::make('hora_cierre')
                    ->required(),
                Toggle::make('es_dia_laboral')
                    ->required(),
            ]);
    }
}
