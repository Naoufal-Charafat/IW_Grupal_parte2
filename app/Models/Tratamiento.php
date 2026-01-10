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

    /**
     * Get the minimum price for this treatment across all active professionals.
     */
    public function getPrecioMinimoAttribute(): float
    {
        $profesionales = $this->profesionales()->wherePivot('esta_activo', true)->get();
        
        if ($profesionales->isEmpty()) {
            return $this->precio;
        }

        $precios = $profesionales->map(function ($profesional) {
            return $profesional->pivot->precio_personalizado ?? $this->precio;
        });

        return $precios->min();
    }

    /**
     * Get the maximum price for this treatment across all active professionals.
     */
    public function getPrecioMaximoAttribute(): float
    {
        $profesionales = $this->profesionales()->wherePivot('esta_activo', true)->get();
        
        if ($profesionales->isEmpty()) {
            return $this->precio;
        }

        $precios = $profesionales->map(function ($profesional) {
            return $profesional->pivot->precio_personalizado ?? $this->precio;
        });

        return $precios->max();
    }

    /**
     * Get the price range as a formatted string.
     */
    public function getRangoPrecioAttribute(): string
    {
        $min = $this->precio_minimo;
        $max = $this->precio_maximo;

        if ($min == $max) {
            return number_format($min, 2) . '€';
        }

        return number_format($min, 2) . '€ - ' . number_format($max, 2) . '€';
    }

    /**
     * Check if this treatment has a price range (different prices across professionals).
     */
    public function hasPriceRange(): bool
    {
        return $this->precio_minimo != $this->precio_maximo;
    }
}
