<?php

namespace App\Filament\Resources\Reservas\Schemas;

use App\Models\Profesional;
use App\Models\Tratamiento;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ReservaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Cliente')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Cliente')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Toggle::make('es_para_otro')
                            ->label('¿Es para otra persona?')
                            ->live()
                            ->default(false),
                        TextInput::make('nombre_paciente')
                            ->label('Nombre del paciente')
                            ->visible(fn(Get $get) => $get('es_para_otro')),
                        TextInput::make('email_paciente')
                            ->label('Email del paciente')
                            ->email()
                            ->visible(fn(Get $get) => $get('es_para_otro')),
                        TextInput::make('telefono_paciente')
                            ->label('Teléfono del paciente')
                            ->tel()
                            ->visible(fn(Get $get) => $get('es_para_otro')),
                    ])
                    ->columns(2),

                Section::make('Servicio y Profesional')
                    ->schema([
                        Select::make('profesional_id')
                            ->label('Profesional')
                            ->options(function () {
                                return Profesional::with('user')
                                    ->get()
                                    ->pluck('user.name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                // Limpiar tratamiento y precio cuando cambia el profesional
                                $set('tratamiento_id', null);
                                $set('monto_total', null);
                                $set('duracion_minutos', null);
                            })
                            ->required(),

                        Select::make('tratamiento_id')
                            ->label('Tratamiento')
                            ->options(function (Get $get) {
                                $profesionalId = $get('profesional_id');

                                if (!$profesionalId) {
                                    return [];
                                }

                                $profesional = Profesional::find($profesionalId);

                                if (!$profesional) {
                                    return [];
                                }

                                // Obtener solo los tratamientos activos para este profesional
                                return $profesional->tratamientos()
                                    ->wherePivot('esta_activo', true)
                                    ->get()
                                    ->mapWithKeys(function ($tratamiento) {
                                        $precio = $tratamiento->pivot->precio_personalizado ?? $tratamiento->precio;
                                        return [$tratamiento->id => "{$tratamiento->nombre} - {$precio}€"];
                                    });
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                if (!$state || !$get('profesional_id')) {
                                    $set('monto_total', null);
                                    $set('duracion_minutos', null);
                                    return;
                                }

                                $profesional = Profesional::find($get('profesional_id'));
                                $tratamiento = $profesional?->tratamientos()
                                    ->where('tratamiento_id', $state)
                                    ->wherePivot('esta_activo', true)
                                    ->first();

                                if ($tratamiento) {
                                    // Establecer precio (personalizado o base)
                                    $precio = $tratamiento->pivot->precio_personalizado ?? $tratamiento->precio;
                                    $set('monto_total', $precio);

                                    // Establecer duración (personalizada o base)
                                    $duracion = $tratamiento->pivot->duracion_personalizada ?? $tratamiento->duracion_minutos;
                                    $set('duracion_minutos', $duracion);
                                }
                            })
                            ->required()
                            ->disabled(fn(Get $get) => !$get('profesional_id'))
                            ->helperText(fn(Get $get) => !$get('profesional_id') ? 'Seleccione primero un profesional' : null),

                        Select::make('habitacion_id')
                            ->relationship('habitacion', 'nombre')
                            ->label('Habitación')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),

                Section::make('Fecha y Hora')
                    ->schema([
                        DatePicker::make('fecha')
                            ->label('Fecha de la cita')
                            ->minDate(now())
                            ->required(),
                        TimePicker::make('hora_inicio')
                            ->label('Hora de inicio')
                            ->seconds(false)
                            ->required(),
                        TimePicker::make('hora_fin')
                            ->label('Hora de fin')
                            ->seconds(false)
                            ->required(),
                        TextInput::make('duracion_minutos')
                            ->label('Duración (minutos)')
                            ->numeric()
                            ->readOnly()
                            ->suffix('min'),
                    ])
                    ->columns(4),

                Section::make('Precio y Estado')
                    ->schema([
                        TextInput::make('monto_total')
                            ->label('Importe Total')
                            ->numeric()
                            ->prefix('€')
                            ->readOnly()
                            ->helperText('Se calcula automáticamente según el profesional y tratamiento seleccionados'),
                        Select::make('estado')
                            ->label('Estado de la cita')
                            ->options([
                                'borrador' => 'Borrador',
                                'bloqueado' => 'Bloqueado',
                                'confirmado' => 'Confirmado',
                                'completado' => 'Completado',
                                'cancelado' => 'Cancelado',
                                'no_asistio' => 'No asistió',
                            ])
                            ->default('confirmado')
                            ->required(),
                        Select::make('estado_pago')
                            ->label('Estado del pago')
                            ->options([
                                'no_pagado' => 'No pagado',
                                'pendiente' => 'Pendiente',
                                'pagado' => 'Pagado',
                                'reembolsado' => 'Reembolsado',
                                'fallido' => 'Fallido',
                            ])
                            ->default('no_pagado')
                            ->required(),
                    ])
                    ->columns(3),

                Section::make('Información Adicional')
                    ->schema([
                        TextInput::make('codigo_confirmacion')
                            ->label('Código de confirmación')
                            ->default(fn() => 'CITA-' . strtoupper(Str::random(8)))
                            ->readOnly()
                            ->helperText('Generado automáticamente'),
                        Textarea::make('notas')
                            ->label('Notas')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('creado_por')
                            ->label('Creado por (ID)')
                            ->default(fn() => auth()->id())
                            ->numeric()
                            ->readOnly(),
                        DateTimePicker::make('expira_en')
                            ->label('Expira en'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
