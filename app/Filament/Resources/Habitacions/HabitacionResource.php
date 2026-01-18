<?php

namespace App\Filament\Resources\Habitacions;

use App\Filament\Resources\Habitacions\Pages\CreateHabitacion;
use App\Filament\Resources\Habitacions\Pages\EditHabitacion;
use App\Filament\Resources\Habitacions\Pages\ListHabitacions;
use App\Filament\Resources\Habitacions\Pages\ViewHabitacion;
use App\Filament\Resources\Habitacions\Schemas\HabitacionForm;
use App\Filament\Resources\Habitacions\Tables\HabitacionsTable;
use App\Models\Habitacion;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HabitacionResource extends Resource
{
    protected static ?string $model = Habitacion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static UnitEnum|string|null $navigationGroup = 'Gestión de tratamientos';

    public static function form(Schema $schema): Schema
    {
        return HabitacionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HabitacionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHabitacions::route('/'),
            'create' => CreateHabitacion::route('/create'),
            'view' => ViewHabitacion::route('/{record}'),
            'edit' => EditHabitacion::route('/{record}/edit'),
        ];
    }
}
