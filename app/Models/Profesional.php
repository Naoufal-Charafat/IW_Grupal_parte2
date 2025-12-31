<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesional extends Model
{
    use HasFactory, HasMedia;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profesionales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'numero_licencia',
        'biografia',
        'tarifa_hora',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tarifa_hora' => 'decimal:2',
    ];

    /**
     * Get the user that owns this professional profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the treatments this professional can perform.
     */
    public function tratamientos(): BelongsToMany
    {
        return $this->belongsToMany(Tratamiento::class, 'profesional_tratamiento')
            ->withPivot(['precio_personalizado', 'duracion_personalizada', 'esta_activo'])
            ->withTimestamps();
    }

    /**
     * Get the time blocks for this professional.
     */
    public function bloquesHorario(): HasMany
    {
        return $this->hasMany(BloqueHorario::class);
    }

    /**
     * Get the reservations for this professional.
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Get the reviews for this professional.
     */
    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class);
    }
}
