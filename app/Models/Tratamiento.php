<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tratamiento extends Model
{
    use HasFactory, HasMedia;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tratamientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion_minutos',
        'esta_activo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio' => 'decimal:2',
        'duracion_minutos' => 'integer',
        'esta_activo' => 'boolean',
    ];

    /**
     * Get the professionals that can perform this treatment.
     */
    public function profesionales(): BelongsToMany
    {
        return $this->belongsToMany(Profesional::class, 'profesional_tratamiento')
            ->withPivot(['precio_personalizado', 'duracion_personalizada', 'esta_activo'])
            ->withTimestamps();
    }

    /**
     * Get the reservations for this treatment.
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Scope to filter only active treatments.
     */
    public function scopeActivo($query)
    {
        return $query->where('esta_activo', true);
    }
}
