<?php

namespace App\Filament\Exports;

use App\Models\Reserva;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ReservaExporter extends Exporter
{
    protected static ?string $model = Reserva::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('codigo_confirmacion')
                ->label('Código de Confirmación'),
            ExportColumn::make('user.name')
                ->label('Usuario'),
            ExportColumn::make('es_para_otro')
                ->label('Es para Otro')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('nombre_paciente')
                ->label('Nombre del Paciente'),
            ExportColumn::make('email_paciente')
                ->label('Email del Paciente'),
            ExportColumn::make('telefono_paciente')
                ->label('Teléfono del Paciente'),
            ExportColumn::make('profesional.nombre')
                ->label('Profesional'),
            ExportColumn::make('habitacion.nombre')
                ->label('Habitación'),
            ExportColumn::make('tratamiento.nombre')
                ->label('Tratamiento'),
            ExportColumn::make('duracion_minutos')
                ->label('Duración (minutos)'),
            ExportColumn::make('fecha')
                ->label('Fecha'),
            ExportColumn::make('hora_inicio')
                ->label('Hora de Inicio'),
            ExportColumn::make('hora_fin')
                ->label('Hora de Fin'),
            ExportColumn::make('estado')
                ->label('Estado'),
            ExportColumn::make('estado_pago')
                ->label('Estado de Pago'),
            ExportColumn::make('monto_total')
                ->label('Monto Total')
                ->formatStateUsing(fn ($state) => number_format($state, 2) . ' €'),
            ExportColumn::make('expira_en')
                ->label('Expira en'),
            ExportColumn::make('created_at')
                ->label('Fecha de Creación'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'La exportación de reservas se ha completado y se ' . ($export->successful_rows === 1 ? 'ha exportado' : 'han exportado') . ' ' . Number::format($export->successful_rows) . ' ' . str('fila')->plural($export->successful_rows) . '.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('fila')->plural($failedRowsCount) . ' no se ' . ($failedRowsCount === 1 ? 'pudo exportar' : 'pudieron exportar') . '.';
        }

        return $body;
    }
}
