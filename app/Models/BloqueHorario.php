<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BloqueHorario extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bloques_horario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profesional_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'motivo',
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
        ];
    }

    /**
     * Get the professional that owns this time block.
     */
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(Profesional::class);
    }
}
