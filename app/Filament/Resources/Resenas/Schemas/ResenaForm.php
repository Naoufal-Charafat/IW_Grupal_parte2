<?php

namespace App\Filament\Resources\Resenas\Schemas;

use App\Models\Reserva;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class ResenaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reserva_id')
                    ->label('Selecciona tu reserva completada')
                    ->helperText('Solo puedes dejar reseñas para reservas que ya has completado')
                    ->options(function ($record) {
                        $query = Reserva::query()
                            ->where('user_id', auth()->id())
                            ->where('estado', 'completado')
                            ->with(['tratamiento', 'profesional.user'])
                            ->orderBy('fecha', 'desc');

                        // En edición, incluir la reserva actual si no tiene reseña aún
                        // En creación, excluir las que ya tienen reseña
                        if ($record && $record->reserva_id) {
                            $query->where(function ($q) use ($record) {
                                $q->whereDoesntHave('resena')
                                    ->orWhere('id', $record->reserva_id);
                            });
                        } else {
                            $query->whereDoesntHave('resena');
                        }

                        $reservas = $query->get();

                        return $reservas->mapWithKeys(function ($reserva) {
                            $label = $reserva->tratamiento->nombre . ' - ' .
                                $reserva->profesional->user->name . ' - ' .
                                $reserva->fecha->format('d/m/Y');
                            return [$reserva->id => $label];
                        });
                    })
                    ->required()
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function ($set, $state) {
                        if ($state) {
                            $reserva = Reserva::with(['user', 'profesional'])->find($state);
                            if ($reserva) {
                                $set('cliente_id', $reserva->user_id);
                                $set('profesional_id', $reserva->profesional_id);
                            }
                        }
                    }),

                Hidden::make('cliente_id')
                    ->default(auth()->id()),

                Hidden::make('profesional_id'),

                TextInput::make('puntuacion')
                    ->label('Puntuación')
                    ->helperText('De 1 a 5 estrellas')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5)
                    ->step(1),

                Textarea::make('comentario')
                    ->label('Comentario')
                    ->helperText('Comparte tu experiencia con el tratamiento')
                    ->rows(4)
                    ->columnSpanFull()
                    ->maxLength(1000),
            ]);
    }
}
