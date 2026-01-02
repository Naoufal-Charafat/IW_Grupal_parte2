<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * Scope to filter only active rooms.
     */
    public function scopeActivo($query)
    {
        return $query->where('esta_activo', true);
    }
}
