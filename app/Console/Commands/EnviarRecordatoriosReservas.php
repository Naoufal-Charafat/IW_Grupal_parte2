<?php

namespace App\Console\Commands;

use App\Mail\ReservaRecordatorio;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarRecordatoriosReservas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservas:enviar-recordatorios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar recordatorios por email para las citas programadas para mañana';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando citas para mañana...');

        // Get tomorrow's date
        $manana = Carbon::tomorrow()->toDateString();

        // Find all confirmed reservations for tomorrow that haven't received a reminder
        $reservas = Reserva::where('fecha', $manana)
            ->where('estado', 'confirmado')
            ->where(function ($query) {
                $query->whereNull('recordatorio_enviado')
                      ->orWhere('recordatorio_enviado', false);
            })
            ->with(['profesional.user', 'tratamiento', 'habitacion', 'user'])
            ->get();

        if ($reservas->isEmpty()) {
            $this->info('No hay citas programadas para mañana que requieran recordatorios.');
            return 0;
        }

        $this->info("Se encontraron {$reservas->count()} citas para mañana.");

        $enviados = 0;
        $errores = 0;

        foreach ($reservas as $reserva) {
            try {
                // Determine recipient email
                $emailDestino = $reserva->email_paciente;

                // Send reminder email
                Mail::to($emailDestino)->send(new ReservaRecordatorio($reserva));

                // Mark reminder as sent
                $reserva->update(['recordatorio_enviado' => true]);

                $enviados++;
                $this->info("✓ Recordatorio enviado para cita {$reserva->codigo_confirmacion} - {$emailDestino}");
            } catch (\Exception $e) {
                $errores++;
                $this->error("✗ Error enviando recordatorio para cita {$reserva->codigo_confirmacion}: {$e->getMessage()}");
                \Log::error("Error enviando recordatorio de reserva {$reserva->id}: " . $e->getMessage());
            }
        }

        $this->newLine();
        $this->info("========================================");
        $this->info("Resumen:");
        $this->info("  Total de citas: {$reservas->count()}");
        $this->info("  Recordatorios enviados: {$enviados}");
        $this->info("  Errores: {$errores}");
        $this->info("========================================");

        return 0;
    }
}
