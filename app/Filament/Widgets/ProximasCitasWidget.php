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
     * Show this widget to clients and professionals
     */
    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['cliente', 'profesional']);
    }

    public function table(Table $table): Table
    {
        $user = auth()->user();
        $isProfessional = $user->hasRole('profesional');

        // Build query based on user role
        $query = Reserva::query()
            ->where('fecha', '>=', now()->toDateString())
            ->whereIn('estado', ['confirmado', 'bloqueado'])
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->limit(5);

        // Filter by user role
        if ($isProfessional) {
            // For professionals, show reservations where they are assigned
            $profesional = $user->profesional;
            if ($profesional) {
                $query->where('profesional_id', $profesional->id);
            } else {
                // If user is professional but no profesional record, show nothing
                $query->whereRaw('1 = 0');
            }
        } else {
            // For clients, show their own reservations
            $query->where('user_id', $user->id);
        }

        return $table
            ->heading($isProfessional ? 'Próximas Citas' : 'Próximas Reservas')
            ->description($isProfessional ? 'Tus próximas citas con pacientes' : 'Tus reservas programadas más próximas')
            ->query($query)
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

                TextColumn::make($isProfessional ? 'user.name' : 'profesional.user.name')
                    ->label($isProfessional ? 'Paciente' : 'Profesional')
                    ->searchable(),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'confirmado' => 'success',
                        'bloqueado' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'confirmado' => 'Confirmada',
                        'bloqueado' => 'Bloqueada',
                        default => ucfirst($state),
                    }),
            ])
            ->emptyStateHeading($isProfessional ? 'No tienes citas próximas' : 'No tienes reservas próximas')
            ->emptyStateDescription($isProfessional ? 'Cuando se te asigne una cita, aparecerá aquí.' : 'Cuando reserves una cita, aparecerá aquí.')
            ->emptyStateIcon('heroicon-o-calendar')
            ->emptyStateActions($isProfessional ? [] : [
                Action::make('reservar')
                    ->label('Reservar Cita')
                    ->icon('heroicon-o-plus')
                    ->url(route('tratamientos.index'))
                    ->color('primary'),
            ]);
    }
}
