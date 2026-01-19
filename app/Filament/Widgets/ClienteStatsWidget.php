<?php

namespace App\Filament\Widgets;

use App\Models\Reserva;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClienteStatsWidget extends BaseWidget
{

    protected function getView(): string
    {
        return 'filament.widgets.cliente-stats-widget';
    }
    protected static ?int $sort = 0;

    /**
     * Only show this widget to clients
     */
    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->hasRole('cliente');
    }

    protected function getStats(): array
    {
        $userId = auth()->id();

        $proximasCitas = Reserva::where('user_id', $userId)
            ->where('fecha', '>=', now()->toDateString())
            ->whereIn('estado', ['confirmado', 'bloqueado'])
            ->count();

        $citasCompletadas = Reserva::where('user_id', $userId)
            ->where('estado', 'completado')
            ->count();

        $totalGastado = Reserva::where('user_id', $userId)
            ->whereIn('estado_pago', ['pagado'])
            ->sum('monto_total');

        $proximaCita = Reserva::where('user_id', $userId)
            ->where('fecha', '>=', now()->toDateString())
            ->whereIn('estado', ['confirmado', 'bloqueado'])
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->first();

        return [
            Stat::make('Próximas Citas', $proximasCitas)
                ->description($proximaCita ? 'Próxima: ' . $proximaCita->fecha->format('d/m/Y') : 'No hay citas programadas')
                ->descriptionIcon($proximaCita ? 'heroicon-o-calendar' : null)
                ->color('success')
                ->chart([7, 5, 10, 5, 12, 4, $proximasCitas]),

            Stat::make('Citas Completadas', $citasCompletadas)
                ->description('Historial de citas realizadas')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('primary')
                ->chart([2, 5, 3, 8, 10, 15, $citasCompletadas]),

            Stat::make('Total Invertido', number_format($totalGastado, 2) . ' €')
                ->description('En tratamientos')
                ->descriptionIcon('heroicon-o-currency-euro')
                ->color('warning'),
        ];
    }
}
