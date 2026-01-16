<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitacion extends Model
{
    use HasFactory, HasMedia;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'habitaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'capacidad',
        'equipamiento',
        'esta_activo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'capacidad' => 'integer',
        'esta_activo' => 'boolean',
    ];

    /**
     * Get the reservations for this room.
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Get the treatments that can be performed in this room.
     */
    public function tratamientos(): BelongsToMany
    {
        return $this->belongsToMany(Tratamiento::class, 'habitacion_tratamiento')
            ->withPivot('es_preferida')
            ->withTimestamps();
    }

    /**
     * Check if this room is available at a specific date and time.
     *
     * @param string $fecha Date in Y-m-d format
     * @param string $horaInicio Time in H:i format
     * @param string $horaFin Time in H:i format
     * @return bool
     */
    public function estaDisponible(string $fecha, string $horaInicio, string $horaFin): bool
    {
        $inicio = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "$fecha $horaInicio");
        $fin = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "$fecha $horaFin");

        // Check for overlapping reservations
        $conflictos = $this->reservas()
            ->where('fecha', $fecha)
            ->whereIn('estado', ['confirmado', 'bloqueado'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->where(function ($q) use ($inicio, $fin) {
                    // New reservation starts during existing reservation
                    $q->where('hora_inicio', '<=', $inicio)
                      ->where('hora_fin', '>', $inicio);
                })
                ->orWhere(function ($q) use ($inicio, $fin) {
                    // New reservation ends during existing reservation
                    $q->where('hora_inicio', '<', $fin)
                      ->where('hora_fin', '>=', $fin);
                })
                ->orWhere(function ($q) use ($inicio, $fin) {
                    // New reservation completely contains existing reservation
                    $q->where('hora_inicio', '>=', $inicio)
                      ->where('hora_fin', '<=', $fin);
                });
            })
            ->exists();

        return !$conflictos;
    }

    /**
     * Scope to filter only active rooms.
     */
    public function scopeActivo($query)
    {
        return $query->where('esta_activo', true);
    }
}
