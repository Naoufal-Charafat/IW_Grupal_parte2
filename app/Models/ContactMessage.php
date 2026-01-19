<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'servicio_interes',
        'mensaje',
        'leido',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'leido' => 'boolean',
    ];
}
