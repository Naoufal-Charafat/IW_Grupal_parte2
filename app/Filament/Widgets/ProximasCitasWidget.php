<?php

namespace App\Filament\Widgets;

use App\Models\Reserva;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ProximasCitasWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';

    /**
     * Only show this widget to clients
     */
    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Próximas Citas')
            ->description('Tus citas programadas más próximas')
            ->query(
                Reserva::query()
                    ->where('user_id', auth()->id())
                    ->where('fecha', '>=', now()->toDateString())
                    ->whereIn('estado', ['confirmado', 'bloqueado'])
                    ->orderBy('fecha')
                    ->orderBy('hora_inicio')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date('d/m/Y - l')
                    ->sortable()
                    ->weight('bold'),
                    
                TextColumn::make('hora_inicio')
                    ->label('Hora')
                    ->time('H:i')
                    ->sortable(),
                    
                TextColumn::make('tratamiento.nombre')
                    ->label('Tratamiento')
                    ->searchable()
                    ->wrap(),
                    
                TextColumn::make('profesional.user.name')
                    ->label('Profesional')
                    ->searchable(),
                    
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmado' => 'success',
                        'bloqueado' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'confirmado' => 'Confirmada',
                        'bloqueado' => 'Bloqueada',
                        default => ucfirst($state),
                    }),
            ])
            ->emptyStateHeading('No tienes citas próximas')
            ->emptyStateDescription('Cuando reserves una cita, aparecerá aquí.')
            ->emptyStateIcon('heroicon-o-calendar')
            ->emptyStateActions([
                Action::make('reservar')
                    ->label('Reservar Cita')
                    ->icon('heroicon-o-plus')
                    ->url(route('tratamientos.index'))
                    ->color('primary'),
            ]);
    }
}
