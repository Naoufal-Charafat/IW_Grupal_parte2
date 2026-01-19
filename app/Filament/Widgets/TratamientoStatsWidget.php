<?php

namespace App\Filament\Widgets;

use App\Models\Tratamiento;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TratamientoStatsWidget extends ChartWidget
{
    protected ?string $heading = 'Estadísticas de Tratamientos';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        // Get only treatments with at least 1 reservation
        $tratamientos = Tratamiento::query()
            ->withCount('reservas')
            ->having('reservas_count', '>', 0)
            ->orderBy('reservas_count', 'desc')
            ->get();

        // If no treatments have reservations, return empty data
        if ($tratamientos->isEmpty()) {
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

        // Generate gradient colors from purple to orange
        $colorPalette = [
            'rgba(168, 85, 247, 0.8)',   // Purple
            'rgba(236, 72, 153, 0.8)',   // Pink
            'rgba(251, 146, 60, 0.8)',   // Orange
            'rgba(59, 130, 246, 0.8)',   // Blue
            'rgba(16, 185, 129, 0.8)',   // Green
            'rgba(139, 92, 246, 0.8)',   // Violet
            'rgba(14, 165, 233, 0.8)',   // Sky
            'rgba(34, 197, 94, 0.8)',    // Emerald
            'rgba(249, 115, 22, 0.8)',   // Orange
            'rgba(244, 63, 94, 0.8)',    // Rose
        ];

        foreach ($tratamientos as $index => $tratamiento) {
            $labels[] = $tratamiento->nombre;
            $data[] = $tratamiento->reservas_count;
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
}
