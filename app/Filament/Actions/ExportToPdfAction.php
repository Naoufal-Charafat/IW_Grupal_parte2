<?php

namespace App\Filament\Actions;

use App\Models\Reserva;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\HeaderAction;
use Illuminate\Support\Carbon;

class ExportToPdfAction
{
    public static function make(): HeaderAction
    {
        return HeaderAction::make('exportToPdf')
            ->label('Exportar a PDF')
            ->icon('heroicon-o-document-arrow-down')
            ->color('danger')
            ->form([
                Select::make('period')
                    ->label('Período')
                    ->options([
                        'custom' => 'Personalizado',
                        'today' => 'Hoy',
                        'yesterday' => 'Ayer',
                        'this_week' => 'Esta Semana',
                        'last_week' => 'Semana Pasada',
                        'this_month' => 'Este Mes',
                        'last_month' => 'Mes Pasado',
                    ])
                    ->default('this_month')
                    ->required()
                    ->live(),
                DatePicker::make('start_date')
                    ->label('Fecha de Inicio')
                    ->visible(fn ($get) => $get('period') === 'custom')
                    ->required(fn ($get) => $get('period') === 'custom'),
                DatePicker::make('end_date')
                    ->label('Fecha de Fin')
                    ->visible(fn ($get) => $get('period') === 'custom')
                    ->required(fn ($get) => $get('period') === 'custom'),
            ])
            ->action(function (array $data) {
                // Calculate date range based on period
                [$startDate, $endDate] = self::getDateRange($data['period'], $data);

                // Query reservations
                $reservas = Reserva::with(['user', 'profesional', 'habitacion', 'tratamiento'])
                    ->whereBetween('fecha', [$startDate, $endDate])
                    ->orderBy('fecha')
                    ->orderBy('hora_inicio')
                    ->get();

                // Generate PDF
                $pdf = Pdf::loadView('pdf.reservas-report', [
                    'reservas' => $reservas,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'period' => $data['period'],
                ])
                ->setPaper('a4', 'landscape');

                // Return PDF download
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, 'reservas-' . $startDate->format('Y-m-d') . '-' . $endDate->format('Y-m-d') . '.pdf');
            });
    }

    protected static function getDateRange(string $period, array $data): array
    {
        $now = Carbon::now();

        return match ($period) {
            'today' => [$now->copy()->startOfDay(), $now->copy()->endOfDay()],
            'yesterday' => [
                $now->copy()->subDay()->startOfDay(),
                $now->copy()->subDay()->endOfDay()
            ],
            'this_week' => [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()],
            'last_week' => [
                $now->copy()->subWeek()->startOfWeek(),
                $now->copy()->subWeek()->endOfWeek()
            ],
            'this_month' => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
            'last_month' => [
                $now->copy()->subMonth()->startOfMonth(),
                $now->copy()->subMonth()->endOfMonth()
            ],
            'custom' => [
                Carbon::parse($data['start_date'])->startOfDay(),
                Carbon::parse($data['end_date'])->endOfDay()
            ],
            default => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
        };
    }
}
