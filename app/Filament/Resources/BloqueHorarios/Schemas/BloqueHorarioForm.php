<?php

namespace App\Filament\Resources\BloqueHorarios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class BloqueHorarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('profesional_id')
                    ->relationship('profesional', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                    ->required(),
                DatePicker::make('fecha')
                    ->required(),
                TimePicker::make('hora_inicio')
                    ->required(),
                TimePicker::make('hora_fin')
                    ->required(),
                TextInput::make('motivo'),
            ]);
    }
}
