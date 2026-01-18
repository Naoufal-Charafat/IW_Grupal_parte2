<?php

namespace App\Filament\Resources\Profesionals;

use App\Filament\Resources\Profesionals\Pages\CreateProfesional;
use App\Filament\Resources\Profesionals\Pages\EditProfesional;
use App\Filament\Resources\Profesionals\Pages\ListProfesionals;
use App\Filament\Resources\Profesionals\Schemas\ProfesionalForm;
use App\Filament\Resources\Profesionals\Tables\ProfesionalsTable;
use App\Models\Profesional;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfesionalResource extends Resource
{
    protected static ?string $model = Profesional::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Profesionales';

    protected static ?string $modelLabel = 'Profesional';

    protected static ?string $pluralModelLabel = 'Profesionales';

    protected static UnitEnum|string|null $navigationGroup = 'Gestión de Personal';

    public static function form(Schema $schema): Schema
    {
        return ProfesionalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfesionalsTable::configure($table);
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
            'index' => ListProfesionals::route('/'),
            'create' => CreateProfesional::route('/create'),
            'edit' => EditProfesional::route('/{record}/edit'),
        ];
    }
}
