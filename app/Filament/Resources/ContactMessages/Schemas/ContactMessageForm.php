<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use App\Models\Tratamiento;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('telefono')
                    ->tel(),
                Select::make('servicio_interes')
                    ->label('Servicio de interés')
                    ->options(fn() => Tratamiento::query()->pluck('nombre', 'nombre'))
                    ->searchable()
                    ->placeholder('Selecciona un servicio...'),
                Textarea::make('mensaje')
                    ->required()
                    ->minLength(10)
                    ->helperText('Mínimo 10 caracteres')
                    ->columnSpanFull(),
                Toggle::make('leido')
                    ->required(),
            ]);
    }
}
