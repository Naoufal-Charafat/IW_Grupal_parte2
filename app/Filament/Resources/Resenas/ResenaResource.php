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

    protected static string|UnitEnum|null $navigationGroup = 'Gestión de tratamientos';

    /**
     * Mostrar este recurso a todos los roles autorizados
     */
    public static function shouldRegisterNavigation(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $user = auth()->user();
        return $user->hasAnyRole(['cliente', 'profesional', 'recepcionista', 'super_admin']);
    }

    /**
     * Permitir acceso según roles autorizados
     */
    public static function canAccess(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $user = auth()->user();
        return $user->hasAnyRole(['cliente', 'profesional', 'recepcionista', 'super_admin']);
    }

    /**
     * Filtrar query según el rol del usuario autenticado
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            // Super admin ve todas las reseñas
            return $query->orderBy('created_at', 'desc');
        }

        if ($user->hasRole('cliente')) {
            // Cliente solo ve sus propias reseñas
            return $query->where('cliente_id', $user->id)
                ->orderBy('created_at', 'desc');
        }

        if ($user->hasRole('profesional')) {
            // Profesional solo ve las reseñas que le han hecho
            $profesional = $user->profesional;
            if ($profesional) {
                return $query->where('profesional_id', $profesional->id)
                    ->orderBy('created_at', 'desc');
            }
            // Si no tiene profesional asociado, no ve nada
            return $query->whereRaw('1 = 0');
        }

        if ($user->hasRole('recepcionista')) {
            // Recepcionista ve todas las reseñas
            return $query->orderBy('created_at', 'desc');
        }

        // Por defecto, no mostrar nada
        return $query->whereRaw('1 = 0');
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
