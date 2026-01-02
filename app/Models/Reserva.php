<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reserva extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'profesional_id',
        'habitacion_id',
        'tratamiento_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'estado_pago',
        'monto_total',
        'expira_en',
        'notas',
        'creado_por',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'hora_inicio' => 'datetime:H:i',
            'hora_fin' => 'datetime:H:i',
            'monto_total' => 'decimal:2',
            'expira_en' => 'datetime',
        ];
    }

    /**
     * Get the client (user) that made the reservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the professional assigned to this reservation.
     */
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(Profesional::class);
    }

    /**
     * Get the room assigned to this reservation.
     */
    public function habitacion(): BelongsTo
    {
        return $this->belongsTo(Habitacion::class);
    }

    /**
     * Get the treatment for this reservation.
     */
    public function tratamiento(): BelongsTo
    {
        return $this->belongsTo(Tratamiento::class);
    }

    /**
     * Get the user who created this reservation.
     */
    public function creador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    /**
     * Get the reviews for this reservation.
     */
    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class);
    }
}
