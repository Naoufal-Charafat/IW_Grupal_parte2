<?php

namespace Database\Seeders;

use App\Models\Resena;
use App\Models\Reserva;
use Illuminate\Database\Seeder;

class ResenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si ya existen reseñas
        if (Resena::count() > 0) {
            echo "Ya existen reseñas en la base de datos\n";
            return;
        }

        // Obtener solo las reservas completadas, ya que solo estas pueden tener reseñas
        $reservasCompletadas = Reserva::where('estado', 'completado')
            ->with(['user', 'profesional'])
            ->get();

        if ($reservasCompletadas->isEmpty()) {
            echo "No hay reservas completadas para crear reseñas. Asegúrate de ejecutar primero el ReservaSeeder.\n";
            return;
        }

        // Comentarios positivos para puntuaciones altas (4-5 estrellas)
        $comentariosPositivos = [
            'Excelente profesional, muy atento y dedicado. El tratamiento fue muy efectivo.',
            'Muy satisfecho con el servicio. El profesional es muy competente y amable.',
            'Una experiencia increíble. Me sentí muy bien atendido y los resultados son visibles.',
            'Profesional altamente capacitado. Recomiendo sus servicios sin dudarlo.',
            'Servicio de primera calidad. El tratamiento superó mis expectativas.',
            'Muy profesional y empático. Explicó todo el proceso con claridad.',
            'Excelente trato y resultados. Volveré sin duda alguna.',
        ];

        // Comentarios neutrales para puntuaciones medias (3 estrellas)
        $comentariosNeutrales = [
            'Buen servicio en general. Cumplió con lo esperado.',
            'El tratamiento fue correcto, aunque esperaba un poco más.',
            'Servicio adecuado. Sin grandes quejas pero tampoco excepcional.',
            'Está bien, aunque hay algunos aspectos que podrían mejorar.',
            'Servicio correcto. Precio acorde a lo recibido.',
        ];

        // Comentarios negativos para puntuaciones bajas (1-2 estrellas)
        $comentariosNegativos = [
            'No estoy del todo satisfecho. Esperaba mejores resultados.',
            'El servicio no cumplió con mis expectativas. Faltó profesionalismo.',
            'Regular. No creo que vuelva a reservar.',
            'Decepcionante. El trato no fue el adecuado.',
            'No recomiendo. Hay mejores opciones en otros centros.',
        ];

        // Crear reseñas para las reservas completadas
        foreach ($reservasCompletadas as $reserva) {
            // Determinar aleatoriamente si esta reserva tendrá reseña (70% de probabilidad)
            if (rand(1, 100) <= 70) {
                // Generar puntuación (más probable que sean buenas reseñas)
                $random = rand(1, 100);
                if ($random <= 60) {
                    // 60% de probabilidad: 4-5 estrellas
                    $puntuacion = rand(4, 5);
                    $comentarios = $comentariosPositivos;
                } elseif ($random <= 85) {
                    // 25% de probabilidad: 3 estrellas
                    $puntuacion = 3;
                    $comentarios = $comentariosNeutrales;
                } else {
                    // 15% de probabilidad: 1-2 estrellas
                    $puntuacion = rand(1, 2);
                    $comentarios = $comentariosNegativos;
                }

                // Seleccionar un comentario aleatorio del array correspondiente
                $comentario = $comentarios[array_rand($comentarios)];

                // Crear la reseña
                Resena::create([
                    'reserva_id' => $reserva->id,
                    'cliente_id' => $reserva->user_id,
                    'profesional_id' => $reserva->profesional_id,
                    'puntuacion' => $puntuacion,
                    'comentario' => $comentario,
                    'created_at' => $reserva->updated_at->addHours(rand(1, 48)), // 1-48 horas después de la reserva
                ]);

                echo "Reseña creada: {$puntuacion} estrellas para la reserva #{$reserva->id}\n";
            }
        }

        $totalResenas = Resena::count();
        echo "\n{$totalResenas} reseñas creadas exitosamente.\n";
    }
}
