<?php

namespace App\Filament\Widgets;

use App\Models\Reserva;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class FacturacionAnualWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    /**
     * Verifica si el widget puede ser visto por el usuario actual.
     */
    public static function canView(): bool
    {
        // Solo super_admin puede ver este widget
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    protected function getStats(): array
    {
        // Calcular facturación del año actual (solo reservas pagadas)
        $inicioAno = now()->startOfYear();
        $finAno = now()->endOfYear();

        $facturacionAnual = Reserva::whereBetween('fecha', [$inicioAno, $finAno])
            ->where('estado_pago', 'pagado')
            ->sum('monto_total');

        // Calcular facturación del año anterior para comparación
        $inicioAnoAnterior = now()->subYear()->startOfYear();
        $finAnoAnterior = now()->subYear()->endOfYear();

        $facturacionAnoAnterior = Reserva::whereBetween('fecha', [$inicioAnoAnterior, $finAnoAnterior])
            ->where('estado_pago', 'pagado')
            ->sum('monto_total');

        // Calcular porcentaje de cambio
        $cambio = 0;
        $descripcion = 'Sin cambios respecto al año anterior';
        $icono = 'heroicon-m-minus';
        $color = 'gray';

        if ($facturacionAnoAnterior > 0) {
            $cambio = (($facturacionAnual - $facturacionAnoAnterior) / $facturacionAnoAnterior) * 100;

            if ($cambio > 0) {
                $descripcion = number_format($cambio, 1) . '% más que el año anterior';
                $icono = 'heroicon-m-arrow-trending-up';
                $color = 'success';
            } elseif ($cambio < 0) {
                $descripcion = number_format(abs($cambio), 1) . '% menos que el año anterior';
                $icono = 'heroicon-m-arrow-trending-down';
                $color = 'danger';
            }
        } elseif ($facturacionAnual > 0) {
            $descripcion = 'Primer año con facturación';
            $icono = 'heroicon-m-arrow-trending-up';
            $color = 'success';
        }

        // Calcular número total de reservas pagadas este año
        $totalReservasPagadas = Reserva::whereBetween('fecha', [$inicioAno, $finAno])
            ->where('estado_pago', 'pagado')
            ->count();

        // Calcular promedio por reserva
        $promedioReserva = $totalReservasPagadas > 0
            ? $facturacionAnual / $totalReservasPagadas
            : 0;

        return [
            Stat::make('Facturación Anual ' . now()->year, '€ ' . number_format($facturacionAnual, 2, ',', '.'))
                ->description($descripcion)
                ->descriptionIcon($icono)
                ->color($color)
                ->chart($this->getChartData()),

            Stat::make('Reservas Pagadas', number_format($totalReservasPagadas, 0, ',', '.'))
                ->description('En el año ' . now()->year)
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),

            Stat::make('Promedio por Reserva', '€ ' . number_format($promedioReserva, 2, ',', '.'))
                ->description('Ticket medio')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('warning'),
        ];
    }

    /**
     * Obtiene datos para el mini gráfico del stat principal.
     */
    protected function getChartData(): array
    {
        // Obtener facturación mensual del año actual
        $datos = [];

        for ($mes = 1; $mes <= 12; $mes++) {
            $fecha = now()->setMonth($mes);
            $mesInicio = $fecha->copy()->startOfMonth();
            $mesFin = $fecha->copy()->endOfMonth();

            $totalMes = Reserva::whereBetween('fecha', [$mesInicio, $mesFin])
                ->where('estado_pago', 'pagado')
                ->sum('monto_total');

            $datos[] = (float) $totalMes;
        }

        return $datos;
    }
}
