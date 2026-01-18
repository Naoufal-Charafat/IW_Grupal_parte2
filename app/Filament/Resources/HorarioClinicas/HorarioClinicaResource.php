<?php

namespace App\Filament\Resources\HorarioClinicas;

use App\Filament\Resources\HorarioClinicas\Pages\CreateHorarioClinica;
use App\Filament\Resources\HorarioClinicas\Pages\EditHorarioClinica;
use App\Filament\Resources\HorarioClinicas\Pages\ListHorarioClinicas;
use App\Filament\Resources\HorarioClinicas\Schemas\HorarioClinicaForm;
use App\Filament\Resources\HorarioClinicas\Tables\HorarioClinicasTable;
use App\Models\HorarioClinica;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HorarioClinicaResource extends Resource
{
    protected static ?string $model = HorarioClinica::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HorarioClinicaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HorarioClinicasTable::configure($table);
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
            'index' => ListHorarioClinicas::route('/'),
            'create' => CreateHorarioClinica::route('/create'),
            'edit' => EditHorarioClinica::route('/{record}/edit'),
        ];
    }
}
