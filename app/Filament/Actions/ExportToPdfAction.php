<?php

namespace App\Filament\Actions;

use App\Models\Reserva;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Support\Carbon;

class ExportToPdfAction
{
    public static function make(): Action
    {
        return Action::make('exportToPdf')
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
                    ->visible(fn($get) => $get('period') === 'custom')
                    ->required(fn($get) => $get('period') === 'custom'),
                DatePicker::make('end_date')
                    ->label('Fecha de Fin')
                    ->visible(fn($get) => $get('period') === 'custom')
                    ->required(fn($get) => $get('period') === 'custom'),
            ])
            ->action(function (array $data) {
                // Calculate date range based on period
                [$startDate, $endDate] = self::getDateRange($data['period'], $data);

                // Obtener el usuario autenticado
                $user = auth()->user();

                // Iniciar la consulta base
                $query = Reserva::with(['user', 'profesional', 'habitacion', 'tratamiento'])
                    ->whereBetween('fecha', [$startDate, $endDate]);

                // Aplicar filtros según el rol del usuario
                if ($user->hasRole('profesional')) {
                    $profesional = $user->profesional;

                    // Si no tiene un registro en la tabla profesionales, no exportar nada
                    if (!$profesional) {
                        $query->whereRaw('1 = 0');
                    } else {
                        // Filtrar solo las reservas de este profesional
                        $query->where('profesional_id', $profesional->id);
                    }
                } elseif ($user->hasRole('cliente')) {
                    // Filtrar solo las reservas del cliente
                    $query->where('user_id', $user->id);
                }
                // Para recepcionista y super_admin, no se aplica filtro adicional

                // Ejecutar la consulta
                $reservas = $query->orderBy('fecha')
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
