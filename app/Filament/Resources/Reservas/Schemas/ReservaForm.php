<?php

namespace App\Filament\Resources\Reservas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReservaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo_confirmacion'),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Toggle::make('es_para_otro')
                    ->required(),
                TextInput::make('nombre_paciente'),
                TextInput::make('email_paciente')
                    ->email(),
                TextInput::make('telefono_paciente')
                    ->tel(),
                Select::make('profesional_id')
                    ->relationship('profesional', 'id')
                    ->required(),
                Select::make('habitacion_id')
                    ->relationship('habitacion', 'id'),
                Select::make('tratamiento_id')
                    ->relationship('tratamiento', 'id')
                    ->required(),
                TextInput::make('duracion_minutos')
                    ->numeric(),
                DatePicker::make('fecha')
                    ->required(),
                TimePicker::make('hora_inicio')
                    ->required(),
                TimePicker::make('hora_fin')
                    ->required(),
                Select::make('estado')
                    ->options([
            'borrador' => 'Borrador',
            'bloqueado' => 'Bloqueado',
            'confirmado' => 'Confirmado',
            'completado' => 'Completado',
            'cancelado' => 'Cancelado',
            'no_asistio' => 'No asistio',
        ])
                    ->default('borrador')
                    ->required(),
                Select::make('estado_pago')
                    ->options([
            'no_pagado' => 'No pagado',
            'pendiente' => 'Pendiente',
            'pagado' => 'Pagado',
            'reembolsado' => 'Reembolsado',
            'fallido' => 'Fallido',
        ])
                    ->default('no_pagado')
                    ->required(),
                TextInput::make('monto_total')
                    ->numeric(),
                DateTimePicker::make('expira_en'),
                Textarea::make('notas')
                    ->columnSpanFull(),
                TextInput::make('creado_por')
                    ->required()
                    ->numeric(),
            ]);
    }
}
