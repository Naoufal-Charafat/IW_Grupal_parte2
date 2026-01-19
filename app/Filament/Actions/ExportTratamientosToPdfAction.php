<?php

namespace App\Filament\Actions;

use App\Models\Tratamiento;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Illuminate\Support\Carbon;

class ExportTratamientosToPdfAction
{
    public static function make(): Action
    {
        return Action::make('exportTratamientosToPdf')
            ->label('Exportar a PDF')
            ->icon('heroicon-o-document-arrow-down')
            ->color('danger')
            ->visible(fn() => auth()->user()?->can('exportPdf', Tratamiento::class) ?? false)
            ->form([
                Checkbox::make('only_active')
                    ->label('Solo tratamientos activos')
                    ->default(true),
            ])
            ->action(function (array $data) {
                // Obtener el usuario autenticado
                $user = auth()->user();

                // Iniciar la consulta base
                $query = Tratamiento::query();

                // Aplicar filtro de tratamientos activos si está seleccionado
                if ($data['only_active'] ?? true) {
                    $query->where('esta_activo', true);
                }

                // Aplicar filtros según el rol del usuario
                if ($user->hasRole('profesional')) {
                    $profesional = $user->profesional;

                    // Si no tiene un registro en la tabla profesionales, no exportar nada
                    if (!$profesional) {
                        $query->whereRaw('1 = 0');
                    } else {
                        // Filtrar solo los tratamientos que este profesional puede realizar
                        $query->whereHas('profesionales', function ($q) use ($profesional) {
                            $q->where('profesionales.id', $profesional->id);
                        });
                    }
                }
                // Para recepcionista y super_admin, no se aplica filtro adicional (pueden ver todos)

                // Ejecutar la consulta
                $tratamientos = $query->orderBy('nombre')->get();

                // Generate PDF
                $pdf = Pdf::loadView('pdf.tratamientos-report', [
                    'tratamientos' => $tratamientos,
                    'generatedAt' => Carbon::now(),
                    'onlyActive' => $data['only_active'] ?? true,
                ])
                    ->setPaper('a4', 'portrait');

                // Return PDF download
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, 'tratamientos-' . now()->format('Y-m-d-His') . '.pdf');
            });
    }
}
