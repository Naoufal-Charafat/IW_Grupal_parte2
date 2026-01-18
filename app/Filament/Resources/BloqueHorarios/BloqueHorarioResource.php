<?php

namespace App\Filament\Resources\BloqueHorarios;

use App\Filament\Resources\BloqueHorarios\Pages\CreateBloqueHorario;
use App\Filament\Resources\BloqueHorarios\Pages\EditBloqueHorario;
use App\Filament\Resources\BloqueHorarios\Pages\ListBloqueHorarios;
use App\Filament\Resources\BloqueHorarios\Schemas\BloqueHorarioForm;
use App\Filament\Resources\BloqueHorarios\Tables\BloqueHorariosTable;
use App\Models\BloqueHorario;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BloqueHorarioResource extends Resource
{
    protected static ?string $model = BloqueHorario::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static UnitEnum|string|null $navigationGroup = 'Gestión de Personal';

    public static function form(Schema $schema): Schema
    {
        return BloqueHorarioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BloqueHorariosTable::configure($table);
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
            'index' => ListBloqueHorarios::route('/'),
            'create' => CreateBloqueHorario::route('/create'),
            'edit' => EditBloqueHorario::route('/{record}/edit'),
        ];
    }
}
