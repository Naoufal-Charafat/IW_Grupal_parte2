<?php

namespace App\Filament\Resources\BloqueHorarios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class BloqueHorarioForm
{
    public static function configure(Schema $schema): Schema
    {
        $user = auth()->user();
        $isProfesional = $user->hasRole('profesional');

        return $schema
            ->components([
                // Si es profesional, ocultar el select y usar un campo hidden
                Hidden::make('profesional_id')
                    ->default(fn() => auth()->user()->profesional?->id)
                    ->visible($isProfesional)
                    ->dehydrated(),

                // Si no es profesional (admin, recepcionista), mostrar el select
                Select::make('profesional_id')
                    ->relationship('profesional', 'id')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->user->name)
                    ->required()
                    ->visible(!$isProfesional),

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
