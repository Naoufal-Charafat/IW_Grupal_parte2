<?php

namespace App\Filament\Widgets;

use App\Models\Reserva;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class FacturacionUltimos4MesesWidget extends ChartWidget
{
    protected ?string $heading = 'Facturación Últimos 4 Meses';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    /**
     * Verifica si el widget puede ser visto por el usuario actual.
     */
    public static function canView(): bool
    {
        // Solo super_admin puede ver este widget
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    protected function getData(): array
    {
        // Obtener los últimos 4 meses
        $meses = collect();
        $importes = collect();

        for ($i = 3; $i >= 0; $i--) {
            $fecha = now()->subMonths($i);
            $mesInicio = $fecha->copy()->startOfMonth();
            $mesFin = $fecha->copy()->endOfMonth();

            // Calcular el total facturado en ese mes (solo reservas pagadas)
            $totalMes = Reserva::whereBetween('fecha', [$mesInicio, $mesFin])
                ->where('estado_pago', 'pagado')
                ->sum('monto_total');

            // Nombre del mes en español
            $nombreMes = $fecha->locale('es')->isoFormat('MMMM YYYY');
            $nombreMes = ucfirst($nombreMes);

            $meses->push($nombreMes);
            $importes->push((float) $totalMes);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Facturación (€)',
                    'data' => $importes->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $meses->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "€" + value.toFixed(2); }',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.dataset.label + ": €" + context.parsed.y.toFixed(2); }',
                    ],
                ],
            ],
        ];
    }
}
