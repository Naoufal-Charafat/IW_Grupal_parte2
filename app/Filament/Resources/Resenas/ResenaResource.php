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
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class ResenaResource extends Resource
{
    protected static ?string $model = Resena::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?string $navigationLabel = 'Reseñas';

    protected static ?string $modelLabel = 'Reseña';

    protected static ?string $pluralModelLabel = 'Reseñas';

    /**
     * Solo mostrar este recurso a clientes
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    /**
     * Solo permitir acceso a clientes
     */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    /**
     * Filtrar query para mostrar solo las reseñas del usuario autenticado
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('cliente_id', auth()->id())
            ->orderBy('created_at', 'desc');
    }

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
