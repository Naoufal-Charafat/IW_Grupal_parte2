<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('line_1'),
                TextInput::make('line_2'),
                TextInput::make('postal_code'),
                Toggle::make('esta_activo')
                    ->required(),
                Select::make('tipo')
                    ->options(['particular' => 'Particular', 'empresa' => 'Empresa'])
                    ->default('particular')
                    ->required(),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->label('Roles')
                    ->helperText('Selecciona uno o más roles para el usuario'),
            ]);
    }
}
