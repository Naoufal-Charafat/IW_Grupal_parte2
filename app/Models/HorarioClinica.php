<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioClinica extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horario_clinica';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dia',
        'hora_apertura',
        'hora_cierre',
        'es_dia_laboral',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dia' => 'integer',
            'hora_apertura' => 'datetime:H:i',
            'hora_cierre' => 'datetime:H:i',
            'es_dia_laboral' => 'boolean',
        ];
    }

    /**
     * Scope to filter only working days.
     */
    public function scopeDiaLaboral($query)
    {
        return $query->where('es_dia_laboral', true);
    }
}
