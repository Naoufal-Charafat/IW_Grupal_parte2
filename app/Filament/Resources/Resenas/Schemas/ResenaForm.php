<?php

namespace App\Filament\Resources\Resenas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ResenaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reserva_id')
                    ->relationship('reserva', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Reserva #{$record->id} - {$record->fecha}")
                    ->required(),
                Select::make('cliente_id')
                    ->relationship('cliente', 'name')
                    ->required(),
                Select::make('profesional_id')
                    ->relationship('profesional', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                    ->required(),
                TextInput::make('puntuacion')
                    ->required()
                    ->numeric(),
                Textarea::make('comentario')
                    ->columnSpanFull(),
            ]);
    }
}
