<?php

namespace App\Filament\Widgets;

use App\Models\Profesional;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProfesionalStatsWidget extends ChartWidget
{
    protected ?string $heading = 'Estadísticas de Profesionales';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Get only professionals with at least 1 reservation
        $profesionales = Profesional::query()
            ->with('user')
            ->withCount('reservas')
            ->having('reservas_count', '>', 0)
            ->orderBy('reservas_count', 'desc')
            ->get();

        // If no professionals have reservations, return empty data
        if ($profesionales->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Número de Reservas',
                        'data' => [],
                    ],
                ],
                'labels' => [],
            ];
        }

        // Prepare data for the chart
        $labels = [];
        $data = [];
        $colors = [];

        // Generate gradient colors from blue to green
        $colorPalette = [
            'rgba(59, 130, 246, 0.8)',   // Blue
            'rgba(16, 185, 129, 0.8)',   // Green
            'rgba(251, 146, 60, 0.8)',   // Orange
            'rgba(168, 85, 247, 0.8)',   // Purple
            'rgba(236, 72, 153, 0.8)',   // Pink
            'rgba(14, 165, 233, 0.8)',   // Sky
            'rgba(34, 197, 94, 0.8)',    // Emerald
            'rgba(249, 115, 22, 0.8)',   // Orange
            'rgba(139, 92, 246, 0.8)',   // Violet
            'rgba(236, 72, 153, 0.8)',   // Pink
        ];

        foreach ($profesionales as $index => $profesional) {
            $labels[] = $profesional->user->name ?? 'Profesional #' . $profesional->id;
            $data[] = $profesional->reservas_count;
            $colors[] = $colorPalette[$index % count($colorPalette)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Número de Reservas',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => array_map(fn($color) => str_replace('0.8', '1', $color), $colors),
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }

    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'super_admin']);
    }
}
