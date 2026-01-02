<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resena extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reserva_id',
        'cliente_id',
        'profesional_id',
        'puntuacion',
        'comentario',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'puntuacion' => 'integer',
        ];
    }

    /**
     * Get the reservation that this review belongs to.
     */
    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class);
    }

    /**
     * Get the client who wrote this review.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Get the professional being reviewed.
     */
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(Profesional::class);
    }
}
