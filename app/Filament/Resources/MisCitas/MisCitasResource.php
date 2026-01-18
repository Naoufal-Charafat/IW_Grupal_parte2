<?php

namespace App\Filament\Resources\MisCitas;

use App\Filament\Resources\MisCitas\Pages\ListMisCitas;
use App\Filament\Resources\MisCitas\Pages\ViewMiCita;
use App\Filament\Resources\MisCitas\Tables\MisCitasTable;
use App\Models\Reserva;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class MisCitasResource extends Resource
{
    protected static ?string $model = Reserva::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    
    protected static ?string $navigationLabel = 'Mis Citas';
    
    protected static ?string $modelLabel = 'Cita';
    
    protected static ?string $pluralModelLabel = 'Mis Citas';
    
    protected static UnitEnum|string|null $navigationGroup = 'Mi Cuenta';
    
    protected static ?int $navigationSort = 1;

    /**
     * Only show this resource to clients
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    /**
     * Only allow clients to access this resource
     */
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    /**
     * Scope query to only show the authenticated user's reservations
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc');
    }

    public static function table(Table $table): Table
    {
        return MisCitasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMisCitas::route('/'),
            'view' => ViewMiCita::route('/{record}'),
        ];
    }
}
