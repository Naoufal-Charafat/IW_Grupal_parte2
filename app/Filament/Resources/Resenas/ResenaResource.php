<?php

namespace App\Filament\Resources\Resenas;

use App\Filament\Resources\Resenas\Pages\CreateResena;
use App\Filament\Resources\Resenas\Pages\EditResena;
use App\Filament\Resources\Resenas\Pages\ListResenas;
use App\Filament\Resources\Resenas\Schemas\ResenaForm;
use App\Filament\Resources\Resenas\Tables\ResenasTable;
use App\Models\Resena;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResenaResource extends Resource
{
    protected static ?string $model = Resena::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ResenaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResenasTable::configure($table);
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
            'index' => ListResenas::route('/'),
            'create' => CreateResena::route('/create'),
            'edit' => EditResena::route('/{record}/edit'),
        ];
    }
}
