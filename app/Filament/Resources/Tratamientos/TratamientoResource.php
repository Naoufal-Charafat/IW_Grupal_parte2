<?php

namespace App\Filament\Resources\Tratamientos;

use App\Filament\Resources\Tratamientos\Pages\CreateTratamiento;
use App\Filament\Resources\Tratamientos\Pages\EditTratamiento;
use App\Filament\Resources\Tratamientos\Pages\ListTratamientos;
use App\Filament\Resources\Tratamientos\Schemas\TratamientoForm;
use App\Filament\Resources\Tratamientos\Tables\TratamientosTable;
use App\Models\Tratamiento;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TratamientoResource extends Resource
{
    protected static ?string $model = Tratamiento::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static UnitEnum|string|null $navigationGroup = 'Gestión de tratamientos';
    

    public static function form(Schema $schema): Schema
    {
        return TratamientoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TratamientosTable::configure($table);
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
            'index' => ListTratamientos::route('/'),
            'create' => CreateTratamiento::route('/create'),
            'edit' => EditTratamiento::route('/{record}/edit'),
        ];
    }
}
